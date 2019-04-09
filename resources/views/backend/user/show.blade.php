@extends('backend.layouts.app')

@section('title', 'Users Profile')

@section('content')
    <!-- BEGIN PROFILE HEADER -->
    {{ Form::model($user, ['route' => ['user.update', $user->name], 'class' => 'form form-validate', 'method' => 'PUT', 'role' => 'form', 'files' => true, 'novalidate' ]) }}
    <input type="hidden" name="status" value="1">
    <section class="full-bleed">
        <div class="section-body style-default-dark force-padding">
            <div class="img-backdrop" style="background-image: url('{{ asset('img/login-bg.jpg') }}')"></div>
            <div class="overlay overlay-shade-top stick-top-left height-3"></div>
            <div class="row margin-bottom-xxl">
                <div class="col-md-3 col-xs-5">
                    <div class="row text-center">
                        <img class="img-circle border-white border-xl auto-width preview" src="{{ user_avatar(140)  }}" alt="user_avatar" style="width: 140px;" />
                    </div>
                </div>
                <div class="col-md-9 col-xs-7">
                    <div class="width-3 text-center pull-right">
                        <strong class="text-xl">{{ $user->followers()->get()->count() }}</strong><br>
                        <span class="text-light opacity-75">followers</span>
                    </div>
                    <div class="width-3 text-center pull-right">
                        <strong class="text-xl">{{ $user->followings()->get()->count() }}</strong><br>
                        <span class="text-light opacity-75">following</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        @include('partials.errors')
        <div class="section-body no-margin">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card card-underline">
                                <div class="card-head">
                                    <header>
                                        <small>Personal info</small>
                                    </header>
                                    <div class="tools">
                                        @if(auth()->user()->isFollowing($user))
                                            <a class="btn btn-primary" href="{{ route('user.un-follow', $user->username) }}">UnFollow</a>
                                        @else
                                            <a class="btn btn-primary" href="{{ route('user.follow', $user->username) }}">Follow</a>
                                        @endif
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('user.contact', $user) }}" class="btn btn-primary">Contact</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list">
                                        <li class="tile">
                                            <a class="tile-content">
                                                <div class="tile-icon">
                                                    <i class="md md-border-color"></i>
                                                </div>
                                                <div class="tile-text">
                                                    {{ $user->name }}
                                                </div>
                                            </a>
                                        </li>
                                        <li class="tile">
                                            <a class="tile-content">
                                                <div class="tile-icon">
                                                    <i class="md md-insert-link"></i>
                                                </div>
                                                <div class="tile-text">
                                                    {{ $user->username }}
                                                </div>
                                            </a>
                                        </li>
                                        <li class="tile">
                                            <a class="tile-content">
                                                <div class="tile-icon">
                                                    <i class="md md-insert-link"></i>
                                                </div>
                                                <div class="tile-text">
                                                    {{ $user->email }}
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-underline style-default-dark">
                                <div class="card-head">
                                    <header class="opacity-75">
                                        <small>Followers</small>
                                    </header>
                                    @include('backend.user.partials.list', ['users'=>$user->followers()->get()])
                                </div>
                            </div>
                            <div class="card card-underline style-default-dark">
                                <div class="card-head">
                                    <header class="opacity-75">
                                        <small>Followings</small>
                                    </header>
                                    @include('backend.user.partials.list', ['users'=>$user->followings()->get()])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card card-underline">
                                <div class="card-head">
                                    <header>
                                        <small>Personal Contents</small>
                                    </header>
                                </div>
                                <div class="card-body">
                                    @forelse($posts as $post)
                                        <article>
                                            <div class="card-body style-default-dark">
                                                <h2>{{ $post->title }}</h2>
                                                <div class="opacity-75">{{ $post->created_at->diffForHumans() }} by
                                                    <a href="{{ route('user.show', $post->author->username) }}">{{ $post->author->name }}</a>
                                                </div>
                                            </div>
                                            <div>
                                                @if($file = $post->files)
                                                    @if(find_file_type($file) == "video/mp4")
                                                        <video poster="{{ $post->image && file_exists($post->image->path) ? asset($post->image->thumbnail(652,367)) : '\img\post-placeholder.png' }}" id="player" playsinline controls style="width:651.33px;">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ Form::close() }}
    <!-- END PROFILE HEADER  -->
@stop

@push('scripts')
    <script src="{{ asset('js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/preview.js') }}"></script>
    <script>
      (function () {
        "use strict";
        $.validator.setDefaults({
          highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
          },
          unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
          },
          errorElement: 'span',
          errorClass: 'help-block',
          errorPlacement: function (error, element) {
            error.insertAfter(element);
          }
        });
      }());
      $(".form-validate-password").validate({
        rules: {
          password: {
            minlength: 8,
            required: true,
            character: true,
            uppercase: true,
            lowercase: true,
            number: true
          },
          password_confirmation: {
            required: true,
            equalTo: "#password"
          }
        },
        messages: {
          password: {
            character: "Must have one these characters !@#$%^&*-",
            uppercase: "Must have at least one uppercase character",
            lowercase: "Must have at least one lowercase character",
            number: "Must have at least one number"
          }
        },
        submitHandler: function (form) {
          form.submit();
        }
      });
      $.validator.addMethod("character", function (value) {
        return /[!@#$%^&*-]/.test(value);
      });
      $.validator.addMethod("lowercase", function (value) {
        return /[a-z]/.test(value);
      });
      $.validator.addMethod("uppercase", function (value) {
        return /[A-Z]/.test(value);
      });
      $.validator.addMethod("number", function (value) {
        return /\d/.test(value);
      });
      $.validator.addMethod("nospaces", function (value) {
        return value.indexOf(" ") < 0;
      });
    </script>
@endpush
