@extends('backend.layouts.app')

@section('title', 'Post')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
@endpush

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head style-primary">
                    <header>
                        <span class="selected-day">Schedule your event here!</span>
                    </header>
                    <div class="tools">
                        <div class="btn-group">
                            <a id="calender-today" href="{{ route('event.create') }}" class="btn btn-flat ink-reaction">Add Event</a>
                        </div>
                    </div>
                </div><!--end .card-head -->
                <div class="card-body padding">
                    {!! $calendar->calendar() !!}
                </div><!--end .card-body -->
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">all events</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('event.create') }}">
                            <i class="md md-add"></i>
                            Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">Title</th>
                            <th width="30%">Start Date</th>
                            <th width="20%">End Date</th>
                            <th width="15%" class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($allEvents as $key => $event)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td class="text-right">
                                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('event.destroy', $event->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No events available.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
@endpush