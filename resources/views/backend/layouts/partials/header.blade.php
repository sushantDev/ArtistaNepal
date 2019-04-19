<header id="header" class="header-inverse">
    <div class="headerbar">
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand">
                    <div class="brand-holder">
                        <a href="{{url('/')}}">
                            <span class="text-lg text-bold text-primary">{{ config('app.name') }}</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="md md-menu"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="headerbar-right">
            <ul class="header-nav header-nav-options">
            </ul>
            <ul class="header-nav header-nav-profile" style="margin-top: -10px;">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                        <img src="{{ auth()->user()->image && file_exists(auth()->user()->image->path) ? asset(auth()->user()->image->thumbnail(80,80)) : '\img\avatar.png' }}">
                        <span class="profile-info">
						{{ ucwords(auth()->user()->name) }}
						<small>{{ ucwords(auth()->user()->roles->first()->name) }}</small>
					</span>
                    </a>
                    <ul class="dropdown-menu animation-dock">
                        <li>
                            <a href="{{ route('user.show', auth()->user()->username) }}">
                                <i class="md md-account-circle"></i>
                                My profile
                            </a>
                        </li>
                        @if(auth()->user()->roles->first()->name == "admin")
                            <li>
                                <a href="{{ route('setting.index') }}">
                                    <i class="md md-settings"></i>
                                    Settings
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{url('/logout')}}">
                                <i class="md md-settings-power text-danger"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>