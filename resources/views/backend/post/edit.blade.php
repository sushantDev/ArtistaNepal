@extends('backend.layouts.app')

@section('title', 'Post')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($post, ['route' =>['post.update', $post->slug],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('backend.post.partials.form', ['header' => 'Edit post <span class="text-primary">('.str_limit($post->title, 47).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop