@extends('backend.layouts.app')

@section('title', 'User Contact')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Compose</h3>
                    <form class="form" id="formCompose" action="{{ route('user.notify') }}">
                        {{ csrf_field() }}
                        <div class="form-group floating-label">
                            <input type="email" class="form-control" id="to1" name="email" value="{{ $user->email }}">
                            <label for="to1">To</label>
                            <a class="link-default pull-right" href="#emailOptions" data-toggle="collapse">More</a>
                        </div><!--end .form-group -->
                        <div id="emailOptions" class="collapse">
                            <div class="form-group floating-label">
                                <input type="email" class="form-control" id="cc1" name="cc">
                                <label for="cc1">CC</label>
                            </div><!--end .form-group -->
                            <div class="form-group floating-label">
                                <input type="email" class="form-control" id="bcc1" name="bcc">
                                <label for="bcc1">BCC</label>
                            </div><!--end .form-group -->
                        </div><!--end #emailOptions -->
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="Subject1" name="subject">
                            <label for="Subject1">Subject</label>
                        </div><!--end .form-group -->
                        <div class="form-group">
                            <textarea id="my-editor" required name="message"></textarea>
                        </div><!--end .form-group -->
                    </form>
                </div>
            </div>
        </div>
        <div class="section-action style-primary">
            <div class="section-action-row">
                <a class="btn ink-reaction btn-icon-toggle" href="{{ route('user.show', $user )}}"><i class="fa fa-chevron-left"></i></a>
            </div>
            <div class="section-floating-action-row">
                <a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="#formCompose" data-submit="form"><i class="md md-send"></i></a>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
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