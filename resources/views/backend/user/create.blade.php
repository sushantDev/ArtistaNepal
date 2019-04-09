@extends('backend.layouts.app')

@section('title', 'User')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'user.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.user.partials.form', ['header' => 'Add a User'])
            {{ Form::close() }}
        </div>
    </section>
@stop