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
                        <li class="breadcrumb-item active">Category</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Slider</h4>
                    @include('validate')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body">
                            <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php
                                $all_slider_data = json_decode($slider -> slider)
                                @endphp
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Slider Video</label>
                                    <div class="col-lg-9">
                                        <input name="svideo" value="{{$all_slider_data->svideo}}" type="text"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"></label>
                                    <div class="col-lg-9">
                                        <div class="slider-container">

                                            @foreach($all_slider_data-> slider as $slide)
                                                <div id="slider_card{{ $slide-> slide_code }}" class="card">
                                                    <div class="card-body">
                                                       <div id="" data-toggle="collapse"
                                                            data-target="#slide{{$slide-> slide_code}}" style="cursor: pointer;" class="form-group"><h4>#Slide {{ $slide-> slide_code }}
                                                               <button id="slide_remove_btn" remove_id="{{ $slide-> slide_code }}"
                                                                       class="close">&times;</button></h4></div>
                                                     <div class="collapse" id="slide{{ $slide-> slide_code }}">
                                                             <div class="card-body" >
                                                                     <div class="form-group">
                                                                             <label for="">Sub Title</label>
                                                                             <input name="slide_code[]" type="hidden"
                                                                  class="form-control">
                                                                             <input name="subtitle[]" value="{{ $slide-> subtitle }}" type="text"
                                                                                    class="form-control">
                                                                         </div>
                                                                     <div class="form-group">
                                                                             <label for="">Title</label>
                                                                             <input name="title[]" value="{{ $slide-> title }}" type="text"
                                                                                    class="form-control">
                                                                         </div>
                                                                     <div class="form-group">
                                                                             <label for="">Button 01 Title</label>
                                                                             <input name="btn1_title[]" value="{{ $slide-> btn1_title }}" type="text"
                                                                                    class="form-control">
                                                                         </div>
                                                                     <div class="form-group">
                                                                             <label for="">Button 01 Link</label>
                                                                             <input name="btn1_link[]" value="{{ $slide-> btn1_link }}" type="text"
                                                                                     class="form-control">
                                                                         </div>
                                                                     <div class="form-group">
                                                                             <label for="">Button 02 Title</label>
                                                                             <input name="btn2_title[]" value="{{
                                                                             $slide-> btn2_title }}" type="text"
                                                                                    class="form-control">
                                                                         </div>
                                                                     <div class="form-group">
                                                                             <label for="">Button 02 Link</label>
                                                                             <input name="btn2_link[]" value="{{
                                                                             $slide-> btn2_link }}" type="text"
                                                                                    class="form-control">
                                                                         </div>
                                                                 </div>
                                                         </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Add Slide</label>
                                    <div class="col-lg-9">
                                        <button id="add_slide" class="btn btn-danger">Add New Slide</button>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
