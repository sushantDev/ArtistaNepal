@extends('backend.layouts.app')

@section('title', $post->title)

@section('content')
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-tiles style-default-light">
                        <!-- BEGIN BLOG POST HEADER -->
                        <div class="row style-primary">
                            <div class="col-sm-9">
                                <div class="card-body style-default-dark">
                                    <h2>{{ $post->title }}</h2>
                                    <div class="text-default-light">Posted by <a href="{{ route('user.show', $post->author->username) }}">{{ $post->author->name }}</a></div>
                                </div>
                            </div><!--end .col -->
                            <div class="col-sm-3">
                                <div class="card-body">
                                    <div class="hidden-xs">
                                        <h3 class="text-light"><strong>{{ $post->created_at->diffForHumans() }}</strong></h3>
                                        <div class="stick-top-right">
                                            <a class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Contact me"><i class="fa fa-envelope"></i></a><br>
                                            <a class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Follow me"><i class="fa fa-twitter"></i></a><br>
                                            <a class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Personal info"><i class="fa fa-facebook"></i></a>
                                        </div>
                                    </div>
                                    <div class="visible-xs">
                                        <strong>15</strong> Jan <a href="#">2 comments <i class="fa fa-comment-o"></i></a>
                                    </div>
                                </div>
                            </div><!--end .col -->
                        </div><!--end .row -->
                        <!-- END BLOG POST HEADER -->

                        <div class="row">
                            <!-- BEGIN BLOG POST TEXT -->
                            <div class="col-md-9">
                                <article class="style-default-bright">
                                    <div>
                                        @if($file = $post->files)
                                            @if(find_file_type($file) == "video/mp4")
                                                <video poster="{{ $post->image && file_exists($post->image->path) ? asset($post->image->thumbnail(900,507)) : '\img\post-placeholder.png' }}" id="player" playsinline controls style="width:795.75px;" >
                                                    <source src="{{ get_file($file) }}" type="{{ find_file_type(($file)) }}" />
                                                </video>
                                            @else(find_file_type($file) == "audio/mpeg")
                                                <img class="img-responsive" src="{{ $post->image && file_exists($post->image->path) ? asset($post->image->thumbnail(900,458)) : '\img\post-placeholder.png' }}" alt="{{ $post->image ? str_slug($post->image->name) : '' }}">
                                                <audio id="player" controls style="width:100%;">
                                                    <source src="{{ get_file($file) }}" type="{{ find_file_type(($file)) }}" />
                                                </audio>
                                            @endif
                                        @else
                                            <img class="img-responsive" src="{{ $post->image && file_exists($post->image->path) ? asset($post->image->thumbnail(900,458)) : '\img\post-placeholder.png' }}" alt="{{ $post->image ? str_slug($post->image->name) : '' }}">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        {!! $post->content !!}
                                        <br>
                                        <div class="well clearfix">
                                            <h4>About the author: {{ $post->author->name }}</h4>
                                            <img class="height-3 pull-right img-circle" src="{{ $user->image && file_exists($user->image->path) ? asset($user->image->thumbnail(140,140)) : '\img\avatar.png' }}" alt="{{ $post->author->name }}">
                                            <p>Email: {{ $post->author->email }}</p>
                                            <p>Username: {{ $post->author->username }}</p>
                                        </div>
                                    </div><!--end .card-body -->
                                </article>
                            </div><!--end .col -->
                            <!-- END BLOG POST TEXT -->

                            <!-- BEGIN BLOG POST MENUBAR -->
                            <div class="col-md-3">
                                <div class="card-body">
                                    <h3 class="text-light">Tags</h3>
                                    <div class="list-tags">
                                        @foreach($post->tags as $tags)
                                            <a class="btn btn-xs btn-primary">{{ $tags->title }}</a>
                                        @endforeach
                                    </div>
                                </div><!--end .card-body -->
                            </div><!--end .col -->
                            <!-- END BLOG POST MENUBAR -->
                        </div><!--end .row -->
                    </div><!--end .card -->
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
@stop