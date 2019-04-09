@extends('backend.layouts.app')

@section('title', 'Patient')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'post.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.post.partials.form', ['header' => 'Create a post'])
            {{ Form::close() }}
        </div>
    </section>
@stop