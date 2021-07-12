<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homePage(){
        return view('frontend.home');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function blogPage(){
        $all_post= Post::latest()->paginate(5);
        return view('frontend.blog', compact('all_post'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function blogsinglePage($slug){
        $singlepost = Post::where('slug', $slug)->take(1)->first();
        return view('frontend.blog-single', compact('singlepost'));
    }


    //post search by category
    public function postByCategory($slug){
        $cats= Category::where('slug',$slug) ->first();
        return view('frontend.category-search', compact('cats'));
    }

    //post search by tag
    public function postByTag($slug){
        $tags= Tag::where('slug',$slug) ->first();
        return view('frontend.tag-search', compact('tags'));

    }


    //post search by Search field
    public function postBySearch(Request $request){
        $search_text= $request->search;

        $posts = Post::where('title','like','%'.$search_text.'%')->orwhere('post_content','like','%'.$search_text.'%')->get();
        return view('frontend.search', compact('posts'));
    }



}

