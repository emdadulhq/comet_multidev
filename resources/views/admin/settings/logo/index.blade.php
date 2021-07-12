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
                        <li class="breadcrumb-item active">Logos and Favicon</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <a class="btn btn-primary" data-toggle="modal" href="#category_modal">Website logo and Favico</a>
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Logo Upload</h4>
                    @include('validate')
                </div>
                <div class="card-body">
                    <form action="{{ route('logo.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <img src="{{URL::to('/')}}/media/settings/logo/{{ $logo -> logo_name }}" alt="">
                            <br>
                            <br>
                            <input type="hidden" name="old_logo" value="{{ $logo -> logo_name }}">
                            <input type="file" name="logo">
                        </div>

                        <div class="form-group">
                            <label for="Logo Width"></label>
                            <input type="text" name="logo_width" class="form-control" value="{{ $logo -> logo_width }}">

                        </div>
                        <input type="submit" class="btn btn-success" value="Update">
                    </form>
                </div>
            </div>

<div id="category_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new Category</h4>

                <button class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <form action="{{ route('posts-category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="name" class="form-control" placeholder="Category name here" type="text">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary btn-block" value="Add" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="category_modal_update" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Category</h4>

                <button class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <form action="{{ route('category.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="id" class="form-control" placeholder="Category name here" type="hidden">
                        <input name="name" class="form-control" placeholder="Category name here" type="text">
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
