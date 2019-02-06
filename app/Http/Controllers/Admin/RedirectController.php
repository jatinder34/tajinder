<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CreateLink;
use App\Models\CloakingFilter;
use App\Models\RedirectLinkTrack;
use Toastr,URL;
class RedirectController extends Controller
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
    public function redirectLink($id)
    {
        // $_SERVER["REMOTE_ADDR"];
        $createlink = CreateLink::find($id);
        $createlink['filter_by'] = explode(',', $createlink->filter_by);
        foreach ($createlink->filter_by as $filter) {
            $filtername = CloakingFilter::find($filter);
            if($filtername->filter_name == "Filter by ISP/Carrier")
            {
                $this->ISPCarrier($id);

            }elseif($filtername->filter_name == "Filter by IP/IP range")
            {
                $this->ip($id);

            }elseif($filtername->filter_name == "Filter by City")
            {
                $this->city($id);

            }elseif($filtername->filter_name == "Filter by Country")
            {
                $this->country($id);

            }else{
                $this->country($id);
            }

        }
        return redirect($createlink->merchent_link);
    }

    public function ISPCarrier($linkid)
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $track = RedirectLinkTrack::where('ip',$ip)->where('linkid',$linkid)->where('type','isp')->get()->first();
        if($track){
           $track->click_count =  $track->click_count + 1;
           if($track->save()){
            return true;
           }
        }else{
            $input = [
                'ip' => $ip,
                'click_count' => 1,
                'type' => 'isp',
                'linkid' => $linkid

            ];
            if(RedirectLinkTrack::create($input)){
                return true;
            }
        }
    }
    public function ip($linkid)
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $track = RedirectLinkTrack::where('ip',$ip)->where('linkid',$linkid)->where('type','ip')->get()->first();
        if($track){
           $track->click_count =  $track->click_count + 1;
           if($track->save()){
            return true;
           }
        }else{
            $input = [
                'ip' => $ip,
                'click_count' => 1,
                'type' => 'ip',
                'linkid' => $linkid

            ];
            if(RedirectLinkTrack::create($input)){
                return true;
            }
        }
    }
    public function city($linkid)
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $track = RedirectLinkTrack::where('ip',$ip)->where('linkid',$linkid)->where('type','city')->get()->first();
        if($track){
           $track->click_count =  $track->click_count + 1;
           if($track->save()){
            return true;
           }
        }else{
            $input = [
                'ip' => $ip,
                'click_count' => 1,
                'type' => 'city',
                'linkid' => $linkid

            ];
            if(RedirectLinkTrack::create($input)){
                return true;
            }
        }
    }

    public function country($linkid)
    {
    $ip = $_SERVER["REMOTE_ADDR"];
        $track = RedirectLinkTrack::where('ip',$ip)->where('linkid',$linkid)->where('type','country')->get()->first();
        if($track){
           $track->click_count =  $track->click_count + 1;
           if($track->save()){
            return true;
           }
        }else{
            $input = [
                'ip' => $ip,
                'click_count' => 1,
                'type' => 'country',
                'linkid' => $linkid

            ];
            if(RedirectLinkTrack::create($input)){
                return true;
            }
        }
    }

    public function default($linkid)
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $track = RedirectLinkTrack::where('ip',$ip)->where('linkid',$linkid)->where('type',null)->get()->first();
        if($track){
           $track->click_count =  $track->click_count + 1;
           if($track->save()){
            return true;
           }
        }else{
            $input = [
                'ip' => $ip,
                'click_count' => 1,
                'type' => null,
                'linkid' => $linkid

            ];
            if(RedirectLinkTrack::create($input)){
                return true;
            }
        }
    }
}