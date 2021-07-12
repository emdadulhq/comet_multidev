@extends('layouts.app')

@section('main-content')

    <!-- Page Wrapper -->
<div class="page-wrapper">

    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome {{ Auth::user()-> name }}!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Posts</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <a class="btn btn-primary" data-toggle="modal" href="#post_modal">Add new post</a>
            <div class="card col-md-12">

                <div class="card-header">
                    <h4 class="card-title">All Posts</h4>
                    @include('validate')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap data_table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Categories</th>
                                <th>Tag</th>
                                <th>Featured Image</th>
                                <th>Author</th>
                                <th>Creation Time</th>
                                <th>Status</th>
                                <th>action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $all_data as $data)
                            <tr>
                                <td> {{ $loop -> index +1 }}</td>

                                <td>{{ Illuminate\Support\Str::limit($data -> title, 30)}}</td>
                                <td class="col-md-2">
                                    @foreach($data-> categories as $category)
                                        <div class="badge badge-info">{{ $category -> name }}</div>
                                    @endforeach
                                </td>
                                <td>{{ $data->tag}}</td>
                                <td>
                                    @if(!empty($data->ftd_img))
                                    <img style="width: 60px; height: 60px;" src="{{ URL::to('/') }}/media/posts/{{
                                $data->ftd_img}}" alt="">
                                    @endif
                                </td>
                                <td>{{ $data->created_at -> diffForHumans()}}</td>
                                <td>{{ $data-> author->name}} </td>

                                <td>


                                @if($data->status== 'Published')
                                        <span class="badge badge-success">Published</span>
                                    @else
                                        <span class="badge badge-danger">Unpublished</span>
                                @endif
                                </td>

                                <td>
                                    @if($data->status== 'Published')
                                        <a class="btn btn-danger btn-sm" href="{{ route('post.unpublished',
                                        $data->id)
                                        }}"><i class="fa fa-eye-slash"
                                               aria-hidden="true"></i></a>

                                        </a>
                                    @else
                                        <a class="btn btn-success btn-sm" href="{{ route('post.published',
                                        $data->id)
                                        }}"><i class="fa fa-eye"
                                               aria-hidden="true"></i></a>
                                    @endif
                                    <a id="post_edit" edit_id="{{ $data->id }}" class="btn btn-sm btn-warning"
                                       data-toggle="modal" href="#">Edit</a>

                                        <form style="display: inline;" action="{{ route('post.destroy', $data->id)
                                        }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

<div id="post_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new post</h4>

                <button class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input name="title" class="form-control" placeholder="Post title here" type="text">
                    </div>


                    <div class="form-group checkbox">
                        <h5 for="">Categories</h5> <hr>
                        @foreach( $categories as $category)
                        <label><input type="checkbox" value="{{ $category-> id }}" name="category[]"> {{ $category ->
                        name }}</label> <br>
                        @endforeach
                    </div>


                    <div class="form-group">
                        <h5 for="">Featured Image </h5><hr>
                        <label style="font-size: 70px; cursor: pointer;" for="ftd_img"><i class="fa
                        fa-camera" aria-hidden="true"></i></label>
                        <input style="display: none;" name="ftd_img" class="" id="ftd_img" type="file">
                        <img style="max-width: 100%; display: block;" id="post_ftd_img_load" src="" alt="">
                    </div>
                    <div class="form-group">
                        <h5 for="">Post Content</h5>
                        <textarea name="post_content" id="post_editor"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary btn-block" value="Add Post" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="post_modal_update" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update post</h4>

                <button class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <form action="{{ route('post.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="id" class="form-control" placeholder="post name here" type="hidden">
                        <input name="title" class="form-control" placeholder="post name here" type="text"> <br>




                        <div class="form-group checkbox">
                            <h5 for="">Categories</h5> <hr>
                            <div class="cl"></div>
                        </div>

                        <div class="form-group">
                            <h5 for="">Featured Image </h5><hr>
                            <label style="font-size: 70px; cursor: pointer;" for="ftd_img_edit"><i class="fa
                        fa-camera" aria-hidden="true"></i></label>
                            <input style="display: none;" name="ftd_img_edit" class="" id="ftd_img_edit" type="file">
                            <img style="max-width: 100%; display: block;" id="post_ftd_img_edit_load" src="" alt="">
                        </div>


                        <div class="form-group">
                            <h5 for="">Post Content</h5>
                            <textarea class="form-control" name="post_content_edit" id=""></textarea>
                        </div>

                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary btn-block" value="Update" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>
</div>
<!-- /Page Wrapper -->
@endsection
