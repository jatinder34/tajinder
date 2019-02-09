<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CreateLink;
use App\Models\CloakingFilter;
use App\Models\RedirectLinkTrack;
use App\Models\Domain;
use App\Models\Country;
use App\Models\LinkFilter;
use Toastr,URL,DB;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Admin.dashboard');
    }

    public function createLink()
    {
        $filters = CloakingFilter::get();
        $country = Country::get();
        $domain = Domain::get();
        
        return view('Admin.create_link',['domain' => $domain,'filters' => $filters,'countries' => $country]);
    }

    public function generateLink(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'affilate_link' => 'required|unique:create_links',
            'merchent_link' => 'required',
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('affilate_link')){
                return array('success'=>false,'message'=>'Link already exist.');
            }
            if($validation->messages()->first('affilate_link')){
                return array('success'=>false,'message'=>'Link already exist.');
            }
        }else{
            $data=array();
            $data['affilate_link']=trim($input['affilate_link']);
            $data['merchent_link']=trim($input['merchent_link']);
            $data['domain']=trim(rtrim($input['domain'],'/'));
            $createlink = CreateLink::create($data);
            if($createlink){
                //$link = URL::to('/admin/go').'/'.$createlink->id;
                $link=$data['domain'];
                $link = $link.'/index.php/'.$createlink->id;
                $message = array('success'=>true,'message'=>'Link generate successfully','url'=>$link);

                /*** To insert Filter Table. ***/

                /** Filter By Ip. ***/
                $filterlink=array();
                $filterlink['link_id']=$createlink->id;
                if($input['ip']>0){
                    $filterlink['type']=1;
                    $filterlink['parameter']=$input['ip'];
                    LinkFilter::create($filterlink);
                }

                if($input['isp']!="" || $input['isp']!=NULL){
                    $filterlink['type']=2;
                    $filterlink['parameter']=$input['isp'];
                    LinkFilter::create($filterlink);
                }

                if($input['browser']!="" || $input['browser']!=NULL){
                    $filterlink['type']=3;
                    $filterlink['parameter']=$input['browser'];
                    LinkFilter::create($filterlink);
                }

                if($input['os']!="" || $input['os']!=NULL){
                    $filterlink['type']=4;
                    $filterlink['parameter']=$input['os'];
                    LinkFilter::create($filterlink);
                }

                if($input['devicetype']!="" || $input['devicetype']!=NULL){
                    $filterlink['type']=5;
                    $filterlink['parameter']=$input['devicetype'];
                    LinkFilter::create($filterlink);
                }

                if($input['country']!="" || $input['country']!=NULL){
                    $filterlink['type']=6;
                    $filterlink['parameter']=$input['country'];
                    LinkFilter::create($filterlink);
                }
                return json_encode($message);
             }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong, please try again!');
                return json_encode($message);
             }
        }
    }

    public function linkList()
    {
        $limit=10;
        $createlink = CreateLink::orderBy('id','DESC')->paginate($limit);
        $create_link = array();
        foreach ($createlink as $link) {
            $unique = RedirectLinkTrack::where('linkid',$link->id)->distinct('ip')->pluck('ip');
            $link->uniqueCount = count($unique);
            $link->click_count = RedirectLinkTrack::where('linkid',$link->id)->sum('click_count');
        }
        return view('Admin.link_list',['createlinks' => $createlink,'limit' => $limit]);
    }

    public function deleteLink(Request $request)
    {
       $input = $request->all();
       $deleteLink = CreateLink::where('id',$input['id'])->delete(); 
       if($deleteLink){
           $message = array('success' => true, 'message' => "Deleted successfully." ); 
           return json_encode($message);
       }else{
           $message = array('success' => false, 'message' => "Somthing went wrong, please try again!" );
           return json_encode($message);         
       }
    }

    public function editLink($linkid)
    {
        $editLink = CreateLink::find($linkid);
        //print_r($editLink);exit;
        $linkfilterType1 = LinkFilter::where('link_id',$linkid)->where('type',1)->first();
        $linkfilterType2 = LinkFilter::where('link_id',$linkid)->where('type',2)->first();
        $linkfilterType3 = LinkFilter::where('link_id',$linkid)->where('type',3)->first();
        $linkfilterType4 = LinkFilter::where('link_id',$linkid)->where('type',4)->first();
        $linkfilterType5 = LinkFilter::where('link_id',$linkid)->where('type',5)->first();
        $linkfilterType6 = LinkFilter::where('link_id',$linkid)->where('type',6)->first();
        $country = Country::get();
        $domain = Domain::get();
        return view('Admin.edit_link',['editdata' => $editLink,'linkfilterType1'=>$linkfilterType1,'linkfilterType2'=>$linkfilterType2,'linkfilterType3'=>$linkfilterType3,'linkfilterType4'=>$linkfilterType4,'linkfilterType5'=>$linkfilterType5,'linkfilterType6'=>$linkfilterType6,'countries'=>$country,'domain'=>$domain]);
    }

    public function updateLink(Request $request)
    {
        $input = $request->all();
        $updateLink = CreateLink::find($input['id']);
        $updateLink->affilate_link = $input['affilate_link'];
        $updateLink->merchent_link = $input['merchent_link'];
        $updateLink->domain = $input['domain'];
        if($updateLink->save()){
            Toastr::success('Link successfully updated', 'Update Link', ["positionClass" => "toast-top-right"]);

            $deleteFilter = LinkFilter::where('link_id',$input['id'])->delete();

            /** Filter By Ip. ***/
            
            $filterlink=array();
            $filterlink['link_id']=$input['id'];
            if($input['ip']>0){
                $filterlink['type']=1;
                $filterlink['parameter']=$input['ip'];
                LinkFilter::create($filterlink);
            }

            if($input['isp']!="" || $input['isp']!=NULL){
                $filterlink['type']=2;
                $filterlink['parameter']=$input['isp'];
                LinkFilter::create($filterlink);
            }

            if($input['browser']!="" || $input['browser']!=NULL){
                $filterlink['type']=3;
                $filterlink['parameter']=$input['browser'];
                LinkFilter::create($filterlink);
            }

            if($input['os']!="" || $input['os']!=NULL){
                $filterlink['type']=4;
                $filterlink['parameter']=$input['os'];
                LinkFilter::create($filterlink);
            }

            if($input['devicetype']!="" || $input['devicetype']!=NULL){
                $filterlink['type']=5;
                $filterlink['parameter']=$input['devicetype'];
                LinkFilter::create($filterlink);
            }

            if($input['country']!="" || $input['country']!=NULL){
                $filterlink['type']=6;
                $filterlink['parameter']=$input['country'];
                LinkFilter::create($filterlink);
            }         



            return redirect('/admin/linkList');
        }else{
            Toastr::error('Somthing went wrong!', 'Update Link', ["positionClass" => "toast-top-right"]);
            return redirect('/admin/editLink/'.$input['id']);
        }
    }
    public function addfilterCategory()
    {
        return view('Admin.add_filter_category');
    }

    public function insertFilter(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'filter_name' => 'required|unique:cloaking_filters',
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('filter_name')){
                Toastr::error('Filter name is already exist.', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/addfilterCategory');
            }
        }else{
            $filter = CloakingFilter::create($input);
            if($filter){
                Toastr::success('Filter category add successfully.', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/filterList');
            }else{
                Toastr::error('Somthing went wrong, please try again!', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/addfilterCategory');
            }
        }
    }

    public function editfilterCategory($id)
    {
        $filter = CloakingFilter::find($id);
        return view('Admin.edit_filter_category',['filter' => $filter]);
    }

    public function updatefilter(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'id' => 'required',
            'filter_name' => 'required|unique:cloaking_filters,filter_name,'.$input['id'],
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('filter_name')){
                return array('success'=>false,'message'=>'Filter name is already exist.');
            }
            if($validation->messages()->first('id')){
                return array('success'=>false,'message'=>'Filter id is required.');
            }
        }else{
            $filter = CloakingFilter::find($input['id']);
            $filter->filter_name = $input['filter_name'];
            if($filter->save()){
                Toastr::success('Filter category update successfully.', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/filterList');
            }else{
                Toastr::error('Somthing went wrong, please try again!', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/editfilterCategory/'.$input['id']);
            }
        }
    }

    public function deleteFilter(Request $request)
    {
       $input = $request->all();
       $deleteFilter = CloakingFilter::where('id',$input['id'])->delete(); 
       if($deleteFilter){
           $message = array('success' => true, 'message' => "Deleted successfully." ); 
           return json_encode($message);
       }else{
           $message = array('success' => false, 'message' => "Somthing went wrong, please try again!" );
           return json_encode($message);         
       }
    }

    public function filterCategoryList()
    {   $limit=10;
        $filters = CloakingFilter::orderBy('id','DESC')->paginate($limit);
        return view('Admin.filter_list',['filters'=> $filters,'limit'=> $limit]);
    }

    public function domainList()
    {   $limit=10;
        $domain = Domain::orderBy('id','DESC')->paginate($limit);
        return view('Admin.domain_list',['domains'=> $domain,'limit'=> $limit]);
    }
    
    public function showAddDomainForm()
    {
        return view('Admin.add_domain');
    }

    public function addDomain(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required|unique:domain',
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('name')){
                Toastr::error('Domain is already exist.', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/adddomain');
            }
        }else{
            $filter = Domain::create($input);
            if($filter){
                Toastr::success('Domain added successfully.', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/domainList');
            }else{
                Toastr::error('Somthing went wrong, please try again!', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/adddomain');
            }
        }
    }

    public function editDomainForm($id)
    {
        $domain = Domain::find($id);
        return view('Admin.edit_domain',['domain' => $domain]);
    }
    

    public function editDomain(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'id' => 'required',
            'name' => 'required|unique:domain,name,'.$input['id'],
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('name')){
                Toastr::error('Domain already exist.', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/editDomain/'.$input['id']);
                //return array('success'=>false,'message'=>'Domain already exist.');
            }
            if($validation->messages()->first('id')){
                Toastr::error('Not a valid domain.', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/editDomain/'.$input['id']);
                //return array('success'=>false,'message'=>'Not a valid domain');
            }
        }else{
            $domain = Domain::find($input['id']);
            $domain->name = $input['name'];
            if($domain->save()){
                Toastr::success('Domain updated successfully.', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/domainList');
            }else{
                Toastr::error('Somthing went wrong, please try again!', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/editDomain/'.$input['id']);
            }
        }
    }

    public function deleteDomain(Request $request)
    {
       $input = $request->all();
       $deleteFilter = Domain::where('id',$input['id'])->delete(); 
       if($deleteFilter){
           $message = array('success' => true, 'message' => "Deleted successfully." ); 
           return json_encode($message);
       }else{
           $message = array('success' => false, 'message' => "Somthing went wrong, please try again!" );
           return json_encode($message);         
       }
    }
    
    public function test(Request $request)
    {
        $post = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'http://ip-api.com/json/122.173.170.229');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $response = curl_exec($ch);
        $result = json_decode($response);
        
        echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
        
        echo "nxt";
        
        echo "<br />";
        
        if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone')) {
           if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone')) {
                echo "iphone";
           }else if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                echo "android";
           }
        }else{
            if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'window')) {
                echo "web";
            }else if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mac')) {
                echo "mac";
            }else{
                echo "Ubuntu";
            }
        }
           
        if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mozilla') && strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'chrome') && strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'safari')) {
            echo "chrome";
        }else if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mozilla') && strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'safari')) {
            echo "safari";
        }else{
           echo "mozila";
        }
           
           
        echo "<br />";
        
        print'<pre>';print_R($result);exit;
    }
    
}
