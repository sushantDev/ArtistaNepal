@extends('backend.layouts.app')

@section('title', 'Emails')

@section('content')
    <div id="content">
        <section class="has-actions style-default-bright">
            <!-- BEGIN INBOX -->
            <div class="section-body">
                <div class="row">
                    <!-- BEGIN INBOX NAV -->
                    <div class="col-sm-4 col-md-3 col-lg-2">
                        <ul class="nav nav-pills nav-stacked nav-icon">
                            <li><small>MAILBOXES</small></li>
                            <li class="active"><a href="http://www.codecovers.eu/materialadmin/mail/inbox"><span class="glyphicon glyphicon-inbox"></span>Inbox <small>{{ count($contacts) }}</small></a></li>
                            <li><a href="http://www.codecovers.eu/materialadmin/mail/inbox">Sent</a></li>
                        </ul>
                    </div><!--end . -->
                    <!-- END INBOX NAV -->

                    <div class="col-sm-8 col-md-9 col-lg-10">
                        <div class="text-divider visible-xs"><span>Email list</span></div>
                        <div class="row">

                            <!-- BEGIN INBOX EMAIL LIST -->
                            <div class="col-md-5 col-lg-4 height-6 scroll-sm">
                                <div class="list-group list-email list-gray">
                                    @forelse($contacts as $contact)
                                        <a href="{{ route('contact.show', $contact) }}" class="list-group-item">
                                            <h5>{{ $contact->subject }}</h5>
                                            <h4>{!! str_limit($contact->message, 80) !!}</h4>
                                            <div class="stick-top-right small-padding text-default-light text-sm">{{ $contact->created_at->diffForHumans() }}</div>
                                        </a>
                                    @empty
                                        <a href="#" class="list-group-item">
                                            <h5>No Emails found!</h5>
                                        </a>
                                    @endforelse
                                </div><!--end .list-group -->
                            </div><!--end .col -->
                            <!-- END INBOX EMAIL LIST -->

                            <!-- BEGIN EMAIL CONTENT -->
                            <div class="col-md-7 col-lg-8">
                                @forelse($featured_contact as $fet)
                                    <div class="text-divider hidden-md hidden-lg"><span>Email</span></div>
                                    <h1 class="no-margin">{{ $fet->subject }}</h1>
                                    <div class="btn-group stick-top-right">
                                        <a href="{{ route('contact.destroy', $fet) }}" class="btn btn-icon-toggle btn-default"><i class="md md-delete"></i></a>
                                    </div>
                                    <span class="pull-right text-default-light">{{ $fet->created_at->diffForHumans() }}</span>
                                    <strong>Sender: {{ $fet->sen_name }}</strong><br>
                                    <strong>Sender Email: {{ $fet->sen_email }}</strong><br>
                                    <strong>Receiver Name: {{ $fet->rec_name }}</strong><br>
                                    <strong>Receiver Email: {{ $fet->rec_email }}</strong><br>
                                    <strong>Price: {{ $fet->price }}</strong><br>
                                    <strong>Venue: {{ $fet->venue }}</strong><br>
                                    <strong>Date: {{ $fet->date }}</strong><br>
                                    <hr>
                                    {!! $fet->message !!}
                                @empty
                                    <h5>No Email found!</h5>
                                @endforelse
                            </div><!--end .col -->
                            <!-- END EMAIL CONTENT -->

                        </div><!--end .row -->
                    </div><!--end .col -->
                </div><!--end .row -->
            </div><!--end .section-body -->
            <!-- END INBOX -->

            <!-- BEGIN SECTION ACTION -->
            <div class="section-action style-primary">
                <div class="section-floating-action-row">
                    <a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="{{ route('user.contact', Auth::user()) }}" data-toggle="tooltip" data-placement="top" data-original-title="Compose">
                        <i class="md md-add"></i>
                    </a>
                </div>
            </div><!--end .section-action -->
            <!-- END SECTION ACTION -->
        </section>
    </div>
@stop