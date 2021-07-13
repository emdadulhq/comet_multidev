@extends('frontend.layouts.app')

@section('main-content')
    <!-- End Navigation Bar-->
    <section class="page-title parallax">
        <div data-parallax="scroll" data-image-src="{{URL::to('/')}}/media/posts/{{$singlepost->ftd_img}}"
             class="parallax-bg"></div>
        <div class="parallax-overlay">
            <div class="centrize">
                <div class="v-center">
                    <div class="container">
                        <div class="title center">
                            <h1 class="upper">{{ $singlepost->title }}<span class="red-dot"></span></h1>
                            <h4>{{ $singlepost-> author -> name }}</h4>
                            <hr>
                        </div>
                    </div>
                    <!-- end of container-->
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="post-single">
                        <div class="post-info">
                            <h2><a href="#">{{ $singlepost->title }}</a></h2>
                            <h6 class="upper"><span>By</span><a href="#"> {{ $singlepost-> author -> name }}</a><span
                                    class="dot"></span><span> {{ $singlepost-> created_at -> diffForHumans() }}</span><span
                                    class="dot"></span>
                                @foreach($singlepost -> categories as $cat_name)
                                    <a href=" {{ $cat_name -> slug }}" class="post-tag">{{ $cat_name -> name
                                    }} .</a></h6>
                            @endforeach
                        </div>
                        <div class="post-media">
                            <img src=" {{ URL::to('/') }}/media/posts/{{ $singlepost-> ftd_img }}" alt="">

                        </div>
                        <div class="post-body">
                            {!! htmlspecialchars_decode($singlepost -> post_content) !!}
                        </div>
                    </article>
                    <!-- end of article-->






                    <div id="comments">
                        <h5 class="upper">3 Comments</h5>
                        <ul class="comments-list">

                            @foreach( $singlepost-> comments as $comment)
                                @if($comment->comment_id==null)


                            <li>
                                <div class="comment">
                                    <div class="comment-pic">
                                        <img src="{{URL::to('frontend/images/team/1.jpg')}}" alt="" class="img-circle">
                                    </div>
                                    <div class="comment-text">
                                        <h5 class="upper">{{$comment->user ->name}}</h5><span
                                            class="comment-date">Posted on
                                            {{date('d F, Y - g:i', strtotime($comment-> created_at))}}</span>
                                        <p> {{$comment->comment_txt}} </p>


                                        @guest
                                            <p>For reply you need <a href="{{ route('login') }}">login</a> first before
                                                place your comments</p>

                                        @else
                                        <a href="#"  class="comment-reply-btn" c_id="{{$comment->id}}">Reply</a>

                                            <div style="display: none;" id="comment_reply_box"
                                                 class="comment-reply-box-{{$comment->id}}">
                                                <form action="{{ route('blog.post.comment.reply') }}" class="comment-form" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" name="post_id" value="{{ $singlepost->id }}">
                                                        <input type="hidden" name="comment_id" value="{{
                                                        $comment->id }}">
                                                        <textarea name="reply_txt" placeholder="Comment"
                                                                  class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-submit text-right">
                                                        <button type="submit" class="btn btn-color-out">Reply
                                                            </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endguest


                                    </div>
                                </div>

                                @php
                                $comments = App\Models\Comment::where('comment_id','!=',null)->where('comment_id', $comment-> id)->get();
                                @endphp

                                @foreach($comments as $comm)
                                <ul class="children">

                                    <li>
                                        <div class="comment">
                                            <div class="comment-pic">
                                                <img src="{{URL::to('frontend/images/team/2.jpg')}}" alt=""
                                                     class="img-circle">
                                            </div>
                                            <div class="comment-text">
                                                <h5 class="upper">{{ $comm -> user ->name }}</h5><span class="comment-date">Posted on 29 September at 10:41</span>
                                                <p>{{ $comm -> comment_txt }}</p>



                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                            </li>
                           @endif
                            @endforeach
                        </ul>
                    </div>



                    @guest
                        <p>Please <a href="{{ route('login') }}">login</a> first before place your comments</p>

                @else

                    <!-- end of comments-->
                    <div id="respond">
                        <h5 class="upper">Leave a comment</h5>
                        @include('validate')
                        <div class="comment-respond">
                            <form action="{{ route('blog.post.comment') }}" class="comment-form" method="POST">
                                @csrf
{{--                                <div class="form-double">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input name="author" type="text" placeholder="Name" class="form-control">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group last">--}}
{{--                                        <input name="email" type="text" placeholder="Email" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <input type="hidden" name="post_id" value="{{ $singlepost->id }}">
                                    <textarea name="comments" placeholder="Comment" class="form-control"></textarea>
                                </div>
                                <div class="form-submit text-right">
                                    <button type="submit" class="btn btn-color-out">Post Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end of comment form-->
                    @endguest



                </div>

{{--                sidebar include--}}
                @include('frontend.layouts.sidebar')

            </div>
            <!-- end of row-->

        </div>
    </section>

@endsection

















