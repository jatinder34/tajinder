<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CreateLink;
use App\Models\CloakingFilter;
use Toastr,URL;
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
        $createlink = CreateLink::get();
        return view('Admin.link_list',['createlinks' => $createlink]);
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

    public function redirectLink($id)
    {
        // $_SERVER["REMOTE_ADDR"];
        $createlink = CreateLink::find($id);
        return redirect($createlink->merchent_link);
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
                return array('success'=>false,'message'=>'Filter name is already exist.');
            }
        }else{
            $filter = CloakingFilter::create($input);
            if($filter){
                $message = array('success'=>true,'message'=>'Filter category add successfully');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong, please try again!');
                return json_encode($message);
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
                $message = array('success'=>true,'message'=>'Filter category update successfully');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong, please try again!');
                return json_encode($message);
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
    {
        $filters = CloakingFilter::get();
        return view('Admin.filter_list',['filters'=> $filters]);
    }
}
