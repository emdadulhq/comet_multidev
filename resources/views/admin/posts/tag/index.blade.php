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
                        <li class="breadcrumb-item active">Tags</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <a class="btn btn-primary" data-toggle="modal" href="#tag_modal">Add new tag</a>
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Tags</h4>
                    @include('validate')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap data_table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tag Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $all_data as $data)
                            <tr>
                                <td> {{ $loop -> index +1 }}</td>
                                <td>{{$data->name}}</td>
                                <td>{{ $data->slug  }}</td>
                                <td>
                                @if($data->status== 'Published')
                                        <span class="badge badge-success">Published</span>
                                    @else
                                        <span class="badge badge-danger">Unpublished</span>
                                @endif
                                </td>

                                <td>
                                    @if($data->status== 'Published')
                                        <a class="btn btn-danger btn-sm" href="{{ route('tag.unpublished',
                                        $data->id)
                                        }}"><i class="fa fa-eye-slash"
                                                                                    aria-hidden="true"></i></a>

</a>
                                    @else
                                        <a class="btn btn-success btn-sm" href="{{ route('tag.published',
                                        $data->id)
                                        }}"><i class="fa fa-eye"
                                                                                    aria-hidden="true"></i></a>
                                    @endif
                                    <a id="tag_edit" edit_id="{{ $data->id }}" class="btn btn-sm btn-warning"
                                    data-toggle="modal"
                                    href="#tag_modal_update">Edit</a>
                                        <form style="display: inline;" action="{{ route('tag.destroy',
                                        $data->id) }}"
                                              method="POST">
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

<div id="tag_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new Tag</h4>

                <button class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <form action="{{ route('tag.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="name" class="form-control" placeholder="Tag name here" type="text">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary btn-block" value="Add" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="tag_modal_update" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update tag</h4>

                <button class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <form action="{{ route('tag.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="id" class="form-control" placeholder="Tag name here" type="hidden">
                        <input name="name" class="form-control" placeholder="Tag name here" type="text">
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

