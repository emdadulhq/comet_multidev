<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('all_data', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this-> validate($request,[
            'title'     => 'required',
            'post_content'   => 'required',

        ]);


        if ($request -> hasFile('ftd_img')){
            $img = $request ->file('ftd_img');
            $file_name= md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img -> move(public_path('media/posts'),$file_name);

        }else{
            $file_name = '';
        }


        $post_user = Post::create([
           'title'          => $request ->title,
           'slug'           => Str::slug($request ->title),
           'user_id'        => Auth::user()->id,
           'post_content'   => $request -> post_content,
           'ftd_img'       => $file_name,
        ]);

        $post_user -> categories() -> attach($request -> category);

        return redirect()-> route('post.index')->with('success', 'Post added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::find($id);
        $post_cat = $data->categories;
        $cat_all =Category::all();

        $checked_id = [];
        foreach ($post_cat as $checked_cat){
            array_push($checked_id, $checked_cat->id);
        }

        $cat_list ="";

        foreach ($cat_all as $cat){
            if (in_array($cat->id, $checked_id)){
                $checked = 'checked';
            }else{
                $checked = '';
            }
            $cat_list .= '<div class="checkbox"><label> <input type="checkbox" '.$checked.' value="'.$cat-> id.'" name="category[]"> '.$cat -> name.' </label></div>';
        }

        return [
            'id'                     => $data -> id,
            'title'                  => $data -> title,
            'ftd_img_edit'           => $data -> ftd_img,
            'cat_list'               => $cat_list,
            'post_content_edit'      => $data -> post_content,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $id = $request -> id;
        $data = Post::find($id);
        $data -> title = $request -> title;
        $data -> post_content = $request -> post_content_edit;
        $data -> slug = Str::slug($request -> title);
        $data -> update();


        $data-> categories() -> detach();
        $data-> categories() -> attach($request-> category);
        return redirect()-> route('post.index')->with('success', 'Post Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Post::find($id);
        $data-> delete();
        return redirect()-> route('post.index')->with('success', 'Post Deleted successfully');
    }





    public function UnpublishedStatus($id){

        $data= Post::find($id);
        $data -> status = 'Unpublished';
        $data -> update();
        return redirect()-> route('post.index')->with('success', 'Post Unpublished successfully');
    }
    public function PublishedStatus($id){

        $data= Post::find($id);
        $data -> status = 'Published';
        $data -> update();
        return redirect()-> route('post.index')->with('success', 'Post Published successfully');
    }
}
