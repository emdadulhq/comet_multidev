<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function LogoIndex(){
        $logo= Settings::find(1);
        return view('admin.settings.logo.index', compact('logo'));
    }
/**
 *
 */
    public function LogoUpdate(Request $request){
        $logo = $request-> file('logo');
        $logo_name= '';
        $old_logo = $request-> old_logo;
        $logo_width = $request-> logo_width;
        if($request-> hasFile('logo')){
            $logo_name= md5(time().rand()).'.'.$logo->getClientOriginalExtension();
            $logo-> move(public_path('media/settings/logo'), $logo_name);
        }else{
            $logo_name =$old_logo;
        }



        $logo_update= Settings::find(1);
        $logo_update -> logo_name = $logo_name;
        $logo_update -> logo_width = $logo_width;
        $logo_update -> update();

        return redirect()-> back()-> with('success', 'Logo update successfull!');
    }

public function socialIndex(){
    $settings= Settings::find(1);
    return view('admin.settings.social.index', compact('settings'));
}

public function socialUpdate(Request $request){
   $social_data =[
       'fb'   => $request->fb,
       'tw'   => $request->tw,
       'li'   => $request->li,
       'in'   => $request->in,
       'dr'   => $request->dr,

   ];
   $social_json=json_encode($social_data);

   $settings = Settings::find(1);
   $settings -> social = $social_json;
   $settings -> update();
   return redirect()-> back()-> with('success', 'Social Links update successfull!');
}

}
