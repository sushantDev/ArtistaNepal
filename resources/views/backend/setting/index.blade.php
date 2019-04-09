@extends('backend.layouts.app')

@section('title', 'Setting')

@section('content')
    <section>
        {{ Form::open(['route'=>'setting.update','class'=>'form form-validate','method'=>'PUT','files'=>true,'novalidate']) }}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-head">
                        <header>General Settings</header>
                        <div class="tools">
                            <input type="submit" class="btn btn-primary" value="Save All">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-head">
                                <header>General</header>
                            </div>
                            <div class="row col-md-12 logo" align="center">
                                <img src="{{ asset(setting('logo')) }}" alt="logo" height="100">
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::text('setting[title]', old('setting.title') ?: setting('title'), ['class'=>'form-control','required']) }}
                                    {{ Form::label('setting[title]', 'Name') }}
                                </div>
                                <div class="form-group">
                                    {{ Form::textarea('setting[address]', old('setting.address') ?: setting('address'), ['class'=>'form-control','rows'=>2,'required']) }}
                                    {{ Form::label('setting[address]', 'Address') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-head">
                                <header>Contacts</header>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::text('setting[phone]', old('setting.phone') ?: setting('phone'), ['class'=>'form-control','required']) }}
                                    {{ Form::label('setting[phone]', 'Phone') }}
                                </div>
                                <div class="form-group">
                                    {{ Form::text('setting[email]', old('setting.email') ?: setting('email'), ['class'=>'form-control','required']) }}
                                    {{ Form::label('setting[email]', 'email') }}
                                </div>
                                <div class="form-group">
                                    {{ Form::text('setting[postbox]', old('setting.postbox') ?: setting('postbox'), ['class'=>'form-control','required']) }}
                                    {{ Form::label('setting[postbox]', 'postbox') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-head">
                        <header>Social Links</header>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::textarea('setting[facebook]', old('setting.facebook') ?: setting('facebook'), ['class'=>'form-control','rows'=>2,'required']) }}
                            {{ Form::label('setting[facebook]', 'Facebook') }}
                        </div>
                        <div class="form-group">
                            {{ Form::textarea('setting[twitter]', old('setting.twitter') ?: setting('twitter'), ['class'=>'form-control','rows'=>2,'required']) }}
                            {{ Form::label('setting[twitter]', 'Twitter') }}
                        </div>
                        <div class="form-group">
                            {{ Form::textarea('setting[google_plus]', old('setting.google_plus') ?: setting('google_plus'), ['class'=>'form-control','rows'=>2,'required']) }}
                            {{ Form::label('setting[google_plus]', 'Google Plus') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </section>
@stop