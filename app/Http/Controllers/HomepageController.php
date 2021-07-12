<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $sliders = Homepage::find(1);
        return view('admin.pages.home.slider.index',[
            'slider'   => $sliders
        ]);

    }

    /**
     * @param Request $request
     */

    public function sliderStore(Request $request){
        $slider_num = count($request->subtitle);
        $slider =[];
        for ($i=0; $i < $slider_num; $i++){
            $slide_arr= [
                'slide_code'    => $request -> slide_code[$i],
                'title'         => $request -> title[$i],
                'subtitle'      => $request -> subtitle[$i],
                'btn1_title'    => $request -> btn1_title[$i],
                'btn1_link'     => $request -> btn1_link[$i],
                'btn2_title'    => $request -> btn2_title[$i],
                'btn2_link'     => $request -> btn2_link[$i],
            ];
            array_push($slider, $slide_arr);
        }

        $slider_arr =[
            'svideo'=> $request->svideo,
            'slider'=> $slider,
        ];
        $slider_json = json_encode($slider_arr);
        $slider_data = Homepage::find(1);
        $slider_data -> slider = $slider_json ;
        $slider_data -> update();
        return redirect()-> route('slider.index')->with('success', 'Slider Updated successfully');


    }
}



























