<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CreateLink;
use App\Models\CloakingFilter;
use App\Models\RedirectLinkTrack;
use App\Models\Domain;
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
        return view('Admin.create_link',['filters' => $filters]);
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
            if(array_key_exists('filter_by', $input)){
                $input['filter_by'] = implode(',', $input['filter_by']);
            }else{
                $input['filter_by'] = null;
            }
            $createlink = CreateLink::create($input);
            if($createlink){
                $link = URL::to('/admin/go').'/'.$createlink->id;
                $message = array('success'=>true,'message'=>'Link generate successfully','url'=>$link);
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
        $editLink['filter_by'] = explode(',',$editLink->filter_by);
        $filters = CloakingFilter::get();
        return view('Admin.edit_link',['editdata' => $editLink,'filters' => $filters]);

    }

    public function updateLink(Request $request)
    {
        $input = $request->all();
        $updateLink = CreateLink::find($input['id']);
        $updateLink->affilate_link = $input['affilate_link'];
        $updateLink->merchent_link = $input['merchent_link'];
        if(array_key_exists('filters', $input)){
            $updateLink->filter_by = implode($input['filters'], ',');
        }
        if($updateLink->save()){
            Toastr::success('Link successfully updated', 'Update Link', ["positionClass" => "toast-top-right"]);
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
}
