@extends('backend.layouts.app')

@section('title', 'User')

@section('content')
  <section>
    <div class="section-body">
      <div class="card">
        <div class="card-head">
          <header class="text-capitalize">all users</header>
          <div class="tools">
            <a class="btn btn-primary ink-reaction" href="{{ route('user.create') }}">
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
              <th width="30%">Name</th>
              <th width="30%" class="text-center">Username</th>
              <th width="20%">Role</th>
              <th width="20%" class="text-center">Email</th>
              <th width="15%" class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $key => $user)
              <tr>
                <td>{{++$key}}</td>
                <td>{{ str_limit($user->name, 47) }}</td>
                <td>{{ str_limit($user->username, 47) }}</td>
                <td>{{ strtoupper($user->roles->first()->name) }}</td>
                <td>{{ str_limit($user->email, 47) }}</td>
                <td class="text-right">
                  <a href="{{route('user.show', $user->username)}}" class="btn btn-flat btn-primary btn-xs">
                    View
                  </a>
                  <a href="{{route('user.edit', $user->username)}}" class="btn btn-flat btn-primary btn-xs">
                    Edit
                  </a>
                  <button type="button" data-url="{{ route('user.destroy', $user->username) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                    Delete
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center">No users available.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
@stop