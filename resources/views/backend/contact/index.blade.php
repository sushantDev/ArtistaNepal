@extends('backend.layouts.app')

@section('title', 'Post')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">all contacts</header>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Name</th>
                            <th width="20%" class="text-center">Email</th>
                            <th width="30%" class="text-center">Message</th>
                            <th width="20%" class="text-center">Document</th>
                            <th width="20%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($contacts as $key => $contact)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{ str_limit($contact->reply, 20) }}</td>
                                <td><a target="_blank" href="{{asset('storage/documents/'. $contact->document)}}">{{ str_limit($contact->document, 20) }}</a></td>
                                <td class="text-right">
                                    <a href="{{route('contact.show', $contact->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        View
                                    </a>
                                    <button type="button" data-url="{{ route('contact.destroy', $contact->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No contacts available.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop