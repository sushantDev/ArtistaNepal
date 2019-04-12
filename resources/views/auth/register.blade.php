@extends('backend.layouts.app')

@section('title', 'Register')

@section('guest')
    <!-- BEGIN LOGIN SECTION -->
    <section class="section-account">
        <div class="row col-md-12 logo" align="center">
            <img src="{{ asset('img/logo.png') }}" alt="logo" height="100">
        </div>
        <div class="row col-md-12" align="center">
            <div class="card col-sm-4 col-sm-offset-4 ">
                <div class="card-body">
                    <br />
                    <span class="text-lg text-bold text-primary">{{ setting('title') }}</span>
                    <br /><br />
                    @include('partials.errors')
                    <form class="form form-validate" role="form" style="text-align:left;" method="POST" action="{{ url('/register') }}" autocomplete="off" novalidate>
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" required>
                            <label for="register">Name</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" required>
                            <label for="register">Username</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" required>
                            <label for="register">Email</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password_confirmation" required>
                            <label for="password_confirmation">Confirm Password</label>
                        </div>
                        <div class="form-group">
                            <select name="role" class="form-control">
                                @foreach($roles as $role)
                                    @if($loop->iteration != 1)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="role">Select Role</label>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                <div class="checkbox checkbox-inline checkbox-styled">

                                </div>
                            </div><!--end .col -->
                            <div class="col-xs-6 text-right">
                                <button class="btn btn-primary btn-raised" type="submit">Register</button>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- END LOGIN SECTION -->

    <footer class="text-center">
        <p>
            <a href="{{ route('login') }}">Or Login</a>
        </p><br>
        <p>
            Copyright &#183; {{ setting('title') }} &#183; {{date('Y')}}
        </p>
    </footer>
@endsection

@push('styles')
    <style type="text/css">
        .logo {
            margin-top: 80px;
            margin-bottom: 15px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
@endpush
