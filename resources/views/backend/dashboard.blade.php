@extends('backend.layouts.app')

@section('title', 'Home')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-bold text-center">Welcome to Artista Nepal's Dashboard.</h1>
                    </div>
                    <hr>
                    @forelse($posts as $post)
                        <article>
                            <div class="card-body style-default-dark">
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="{{ route('user.show', $post->author) }}"><img class="img-circle border-white border-xl img-responsive auto-width" src="{{ $post->author->image && file_exists($post->author->image->path) ? asset($post->author->image->thumbnail(80,80)) : '\img\avatar.png' }}"></a>
                                    </div>
                                    <div class="col-md-10">
                                        <h2>{{ $post->title }}</h2>
                                        <div class="opacity-75">{{ $post->created_at->diffForHumans() }} by
                                            <a href="{{ route('user.show', $post->author->username) }}">{{ $post->author->name }}</a> {{ strtoupper($post->author->roles->first()->name) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @if($file = $post->files)
                                    @if(find_file_type($file) == "video/mp4")
                                        <video poster="{{ $post->image && file_exists($post->image->path) ? asset($post->image->thumbnail(1085,610)) : '\img\post-placeholder.png' }}" id="player" playsinline controls style="width:1085px;" >
                                            <source src="{{ get_file($file) }}" type="{{ find_file_type(($file)) }}" />
                                        </video>
                                    @else(find_file_type($file) == "audio/mpeg")
                                        <img class="img-responsive" src="{{ $post->image && file_exists($post->image->path) ? asset($post->image->thumbnail(1085,607)) : '\img\post-placeholder.png' }}" alt="{{ $post->image ? str_slug($post->image->name) : '' }}">
                                        <audio id="player" controls style="width:100%;">
                                            <source src="{{ get_file($file) }}" type="{{ find_file_type(($file)) }}" />
                                        </audio>
                                    @endif
                                @else
                                    <img class="img-responsive" src="{{ $post->image && file_exists($post->image->path) ? asset($post->image->thumbnail(1085,607)) : '\img\post-placeholder.png' }}" alt="{{ $post->image ? str_slug($post->image->name) : '' }}">
                                @endif
                            </div>
                            <div class="card-body style-default-bright">
                                {!! str_limit($post->content, 250) !!}
                                <br>
                                <a class="btn btn-default" href="{{ route('post.show', $post) }}">Read more</a>
                            </div>
                        </article>
                    @empty
                        <h2>No Posts Found!</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection