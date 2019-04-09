@extends('backend.layouts.app')

@section('title', 'Post')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">all posts</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('post.create') }}">
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
                            <th width="60%">Name</th>
                            <th width="20%" class="text-center">Published</th>
                            <th width="15%" class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $key => $post)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ str_limit($post->title, 47) }}</td>
                                <td class="text-center">
                                    <span class="badge">{{ $post->is_published ? 'Yes' : 'No' }}</span>
                                </td>
                                <td class="text-right">
                                    <a href="{{route('post.edit', $post->slug)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('post.destroy', $post->slug) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No posts available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop