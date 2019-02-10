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
        //print_R($ip);exit;

        $createlink = CreateLink::find($id);
        $linkfilter = LinkFilter::where('link_id',$createlink->id)->get();
        if(count($linkfilter)>0){
            $post = [];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,'http://ip-api.com/json/'.$ip);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
            $response = curl_exec($ch);
            $result = json_decode($response);

            $ipcount=$this->ip($id);
            $tocheck=0;
            $totcount=count($linkfilter);
            foreach ($linkfilter as $filter) {
                if($filter->type=='1'){
                    if($ipcount>1){
                        $tocheck=$tocheck+1;
                    }
                }
                if($filter->type=='2'){
                    if(strstr(strtolower($result->as), $filter->parameter) || strstr(strtolower($result->isp), $filter->parameter)) {
                        $tocheck=$tocheck+1;
                    }else{
                        if($tocheck>0){
                            $tocheck=$tocheck-1;
                        }else{
                            $tocheck=0;
                        }
                    }
                }
                if($filter->type=='3'){
                    if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mozilla') && strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'chrome') && strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'safari')) {
                        if($filter->parameter=='chrome'){
                           $tocheck=$tocheck+1; 
                        }else{
                            if($tocheck>0){
                               $tocheck=$tocheck-1;
                            }else{
                                $tocheck=0;
                            }
                        }
                    }else if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mozilla') && strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'safari')) {
                        if($filter->parameter=='safari'){
                            $tocheck=$tocheck+1; 
                        }else{
                            if($tocheck>0){
                               $tocheck=$tocheck-1;
                            }else{
                                $tocheck=0;
                            }
                        }
                    }else{
                        if($filter->parameter=='mozilla'){
                            $tocheck=$tocheck+1; 
                        }else{
                            if($tocheck>0){
                               $tocheck=$tocheck-1;
                            }else{
                                $tocheck=0;
                            }
                        }
                    }
                }
                if($filter->type=='4'){
                    if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'window')) {
                        if($filter->parameter=='window'){
                            $tocheck=$tocheck+1; 
                        }else{
                            if($tocheck>0){
                                $tocheck=$tocheck-1;
                            }else{
                                $tocheck=0;
                            }
                        }
                    }else if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mac')) {
                        if($filter->parameter=='mac'){
                            $tocheck=$tocheck+1; 
                        }else{
                            if($tocheck>0){
                                $tocheck=$tocheck-1;
                            }else{
                                $tocheck=0;
                            }
                        }
                    }else{
                        if($filter->parameter=='ubuntu'){
                            $tocheck=$tocheck+1; 
                        }else{
                            if($tocheck>0){
                               $tocheck=$tocheck-1;
                            }else{
                                $tocheck=0;
                            }
                        }
                    }
                }
                if($filter->type=='5'){
                    if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone')) {
                            if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone')){
                                if($filter->parameter=='iphone'){
                                   $tocheck=$tocheck+1; 
                                }else{
                                    if($tocheck>0){
                                       $tocheck=$tocheck-1;
                                    }else{
                                        $tocheck=0;
                                    }
                                }
                            }else if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                                if($filter->parameter=='android'){
                                    $tocheck=$tocheck+1; 
                                }else{
                                    if($tocheck>0){
                                       $tocheck=$tocheck-1;
                                    }else{
                                        $tocheck=0;
                                    }
                                }
                            }else{
                                if($filter->parameter=='desktop'){
                                    $tocheck=$tocheck+1; 
                                }else{
                                    if($tocheck>0){
                                       $tocheck=$tocheck-1;
                                    }else{
                                        $tocheck=0;
                                    }
                                }
                            }
                        }
                }
                if($filter->type=='6'){
                    if(strstr(strtolower($result->country), strtolower($filter->parameter))) {
                        $tocheck=$tocheck+1;
                    }else{
                        if($tocheck>0){
                            $tocheck=$tocheck-1;
                        }else{
                            $tocheck=0;
                        }
                    }
                }
            }
            if($tocheck>0){
                if($tocheck==$totcount){
                    $redirecturl = $createlink->merchent_link;
                }else{
                    $redirecturl = $createlink->affilate_link;
                }
            }else{
                $redirecturl = $createlink->affilate_link;
            }
        }else{
            $redirecturl = $createlink->affilate_link;
        }
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
            return $data=$track->click_count;
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
                return $data=1;
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