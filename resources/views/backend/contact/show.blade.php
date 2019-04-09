@extends('backend.layouts.app')

@section('title', 'Contact')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    @include('partials.errors')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-head">
                            <header>{{ "View Contact" }}</header>
                            <div class="tools visible-xs">
                                <a class="btn btn-default btn-ink" onclick="history.go(-1);return false;">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        Name : {{ $contact->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        Email : {{ $contact->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        Message : {{ $contact->reply }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a target="_blank" class="btn ink-reaction btn-primary" href="{{asset('storage/documents/'. $contact->document)}}">Download Attachment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @push('styles')
            <link href="{{ asset('backend/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-select.min.css') }}">
            @endpush

            @push('scripts')
            <script src="{{ asset('backend/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('backend/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
            <script src="{{ asset('backend/js/libs/dropify/dropify.min.js') }}"></script>
            <script src="{{ asset('/backend/js/bootstrap-select.js') }}"></script>
            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('my-editor', {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
                });
            </script>
            @endpush
        </div>
    </section>
@stop
