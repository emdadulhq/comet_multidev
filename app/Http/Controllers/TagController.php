<?php

namespace App\Http\Controllers;


use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Tag::all();
        return view('admin.posts.tag.index', compact('all_data'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required | unique:tags'
        ]);

        Tag::create([
            'name'  => $request-> name,
            'slug'  => Str::slug($request->name)
        ]);

        return redirect()-> route('tag.index')->with('success', 'Tag added successfully');

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
        $data = Tag::find($id);
        return [
            'name' => $data-> name,
            'id' => $data-> id,
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
        $data = Tag::find($id);
        $data -> name = $request -> name;
        $data -> slug = Str::slug($request -> name);
        $data -> update();
        return redirect()-> route('tag.index')->with('success', 'Tag Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tag::find($id);
        $data-> delete();
        return redirect()-> route('tag.index')->with('success', 'Tag Deleted successfully');

    }



    public function UnpublishedStatus($id){

        $data= Tag::find($id);
        $data -> status = 'Unpublished';
        $data -> update();
        return redirect()-> route('tag.index')->with('success', 'Tag Unpublished successfully');
    }
    public function PublishedStatus($id){

        $data= Tag::find($id);
        $data -> status = 'Published';
        $data -> update();
        return redirect()-> route('tag.index')->with('success', 'Tag Published successfully');
    }
}
