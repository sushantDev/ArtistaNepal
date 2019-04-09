@extends('backend.layouts.app')

@section('title', 'User')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($user, ['route' =>['user.update', $user->username],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('backend.user.partials.form', ['header' => 'Edit user <span class="text-primary">('.str_limit($user->name, 47).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop