@extends('backend.layouts.app')

@section('title', 'Event')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'event.store','class'=>'form form-validate','role'=>'form', 'novalidate']) }}
            @include('backend.schedule.partials.form', ['header' => 'Add an Event'])
            {{ Form::close() }}
        </div>
    </section>
@stop