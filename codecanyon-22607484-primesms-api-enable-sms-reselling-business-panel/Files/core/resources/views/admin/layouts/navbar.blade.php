<header class="app-header"><a class="app-header__logo" href="{{ route('admin.dashboard') }}"><img
                src="{{ asset('assets/user/upload/logo/logo.png') }}"
                style="max-width: 200px; max-height: 45px; margin-bottom: 5px"></a>
    @php
        $supportCount = \App\SupportTicket::whereIn('status', [0,2])->count();
        $supports = \App\SupportTicket::whereIn('status', [0,2])->orderBy('updated_at', 'DESC')->get();
    @endphp
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i
                        class="fa fa-bell-o fa-lg"></i>@if($supportCount > 0)<span
                        class="badge badge-pill badge-light badge-custom">{{ $supportCount }}</span>@endif</a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <li class="app-notification__title">You have {{ $supportCount }} new Message.</li>
                @if($supportCount > 0)
                    @foreach($supports as $support)
                        <div class="app-notification__content">
                            <li><a class="app-notification__item" href="javascript:;"><span
                                            class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                                    class="fa fa-circle fa-stack-2x text-primary"></i><i
                                                    class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">Ticket: #{{ $support->ticket }}</p>
                                        <p class="app-notification__meta">{{ $support->updated_at->diffForHumans() }}</p>
                                    </div>
                                </a></li>
                        </div>
                    @endforeach
                @endif
                <li class="app-notification__footer"><a href="{{ route('admin.pending.ticket') }}">See all messages.</a>
                </li>
            </ul>
        </li>
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                        class="fa fa-user fa-lg"></i> {{ Auth::guard('admin')->user()->username }}</a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="{{ route('admin.pass.change') }}"><i class="fa fa-cog fa-lg"></i>
                        Change Password</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>
</header>