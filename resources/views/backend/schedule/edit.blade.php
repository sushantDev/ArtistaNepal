@extends('backend.layouts.app')

@section('title', 'Event')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($event, ['route' =>['event.update', $event->id],'class'=>'form form-validate','role'=>'form', 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('backend.schedule.partials.form', ['header' => 'Edit event <span class="text-primary">('.str_limit($event->title, 47).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop