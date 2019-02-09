<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CreateLink;
use App\Models\CloakingFilter;
use App\Models\RedirectLinkTrack;
use App\Models\LinkFilter;
use Toastr,URL,Cookie;
class RedirectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /*public function redirectLink(Request $request,$id)
    {
        $url = URL::current();
        Cookie::queue(Cookie::make('redirecturl', $url));
        $value = $request->cookie('redirecturl');
        $ip = $_SERVER["REMOTE_ADDR"];
        $createlink = CreateLink::find($id);
        $redirect = RedirectLinkTrack::where('ip',$ip)->where('linkid',$id)->count();
        if($redirect != 0 || $value == $url){
            $redirecturl = $createlink->merchent_link;
        }else{
            $redirecturl = $createlink->affilate_link;
        }
        $createlink['filter_by'] = explode(',', $createlink->filter_by);
        if(count($createlink['filter_by']) == 1){
            $this->ip($id);
        }else{
            foreach ($createlink->filter_by as $filter) {
                $filtername = CloakingFilter::find($filter);
                if($filtername->filter_name == "ISP/Carrier")
                {
                    $this->ISPCarrier($id);

                }elseif($filtername->filter_name == "IP/IP range")
                {
                    $this->ip($id);

                }elseif($filtername->filter_name == "City")
                {
                    $this->city($id);

                }elseif($filtername->filter_name == "County")
                {
                    $this->country($id);

                }else{
                    $this->ip($id);
                }

            }
        }
        return redirect($redirecturl);
    }

    */

    public function redirectLink(Request $request,$id)
    {
        $url = URL::current();
        $ip = $_SERVER["REMOTE_ADDR"];
        print_R($ip);exit;
        return redirect($redirecturl);
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
                'linkid' => $linkid,
                'city' =>null,
                'country'=>null 

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
                'linkid' => $linkid,
                'city' =>null,
                'country'=>null

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
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
            $input = [
                'ip' => $ip,
                'click_count' => 1,
                'type' => 'city',
                'linkid' => $linkid,
                'city' =>$details->city,
                'country'=>null
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
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
            $input = [
                'ip' => $ip,
                'click_count' => 1,
                'type' => 'country',
                'linkid' => $linkid,
                'city' =>null,
                'country'=>$details->country

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
                'linkid' => $linkid,
                'city' =>null,
                'country'=>null

            ];
            if(RedirectLinkTrack::create($input)){
                return true;
            }
        }
    }
}