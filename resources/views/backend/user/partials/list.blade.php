<div class="card-body no-padding">
    <ul class="list">
        @if($users->count())
            @foreach($users as $user)
                <li class="tile">
                    <a class="tile-content ink-reaction" href="{{ route('user.show', $user) }}">
                        <div class="tile-icon">
                            <img src="{{ $user->image && file_exists($user->image->path) ? asset($user->image->thumbnail(80,80)) : '\img\avatar.png' }}" alt="{{ $user->name }}">
                        </div>
                        <div class="tile-text">{{ $user->name }}<small>{{ $user->username }}</small></div>
                        <div class="tools">
                            @if(auth()->user()->isFollowing($user))
                                <a class="btn btn-xs btn-primary" href="{{ route('user.un-follow', $user->username) }}">UnFollow</a>
                            @else
                                <a class="btn btn-xs btn-primary" href="{{ route('user.follow', $user->username) }}">Follow</a>
                            @endif
                        </div>
                    </a>
                </li>
            @endforeach
        @else
            <p>Not Found!</p>
        @endif
    </ul>
</div>