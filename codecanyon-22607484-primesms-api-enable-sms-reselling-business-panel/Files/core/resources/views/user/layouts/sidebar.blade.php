<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar"
                                        src="{{ asset('assets/user/upload/profile') }}/{{ Auth::user()->image != null ? Auth::user()->image : 'default.png'}}"
                                        alt="{{ Auth::user()->name }}" style="max-height: 48px; max-width: 48px;">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
            <p class="app-sidebar__user-designation"><a class="profile-link" href="{{ route('my.profile') }}">My
                    Profile</a></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item @if(request()->path() == 'user/dashboard') active @endif"
               href="{{ route('user.home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span
                        class="app-menu__label">Dashboard</span></a></li>
        @if(Auth::user()->refer_by == 0)
            <li><a class="app-menu__item @if(request()->path() == 'user/smsPlans') active @endif"
                   href="{{ route('user.sms.plan') }}"><i class="app-menu__icon fa fa-tasks"></i><span
                            class="app-menu__label">SMS Plans</span></a></li>
        @endif
        <li><a class="app-menu__item @if(request()->path() == 'user/coverage') active @endif"
               href="{{ route('user.coverage') }}"><i class="app-menu__icon fa fa-wifi"></i><span
                        class="app-menu__label">Routing/Coverage</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'user/sendSMS') active @endif"
               href="{{ route('user.sms.send') }}"><i class="app-menu__icon fa fa-envelope"></i><span
                        class="app-menu__label">Send SMS</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'user/apiDocumentation') active @endif"
               href="{{ route('api.doc') }}"><i class="app-menu__icon fa fa-globe"></i><span
                        class="app-menu__label">API</span></a></li>
        @if(Auth::user()->refer_by == 0 && Auth::user()->roll == 1)
            <li class="treeview
@if(request()->path() == 'user/myClients') is-expanded
@elseif(request()->path() == 'user/addClient') is-expanded
@elseif(request()->path() == 'user/broadcast') is-expanded
@endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-plus"></i><span
                            class="app-menu__label">My Clients</span><i
                            class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item @if(request()->path() == 'user/myClients') active @endif"
                           href="{{ route('user.clients') }}"><i class="icon fa fa-circle-o"></i> All Client</a>
                    </li>
                    <li><a class="treeview-item @if(request()->path() == 'user/addClient') active @endif"
                           href="{{ route('add.client') }}"><i class="icon fa fa-circle-o"></i>Add Clients</a>
                    </li>
                    <li><a class="treeview-item @if(request()->path() == 'user/broadcast') active @endif"
                           href="{{ route('user.broadcast') }}"><i class="icon fa fa-circle-o"></i>Broadcast Mail</a>
                    </li>
                </ul>
            </li>
        @endif
        <li><a class="app-menu__item @if(request()->path() == 'user/smsLog') active @endif"
               href="{{ route('user.smsLog') }}"><i class="app-menu__icon fa fa-bars"></i><span
                        class="app-menu__label">SMS Log</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'user/transactionLog') active @endif"
               href="{{ route('user.transactionLog') }}"><i class="app-menu__icon fa fa-bars"></i><span
                        class="app-menu__label">Transaction Log</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'user/verification') active @endif"
               href="{{ route('user.verification') }}"><i class="app-menu__icon fa fa-lock"></i><span
                        class="app-menu__label">2-step verification</span></a></li>
        @if(Auth::user()->refer_by == 0)
            <li><a class="app-menu__item @if(request()->path() == 'user/supportTicket') active @endif"
                   href="{{ route('user.ticket') }}"><i class="app-menu__icon fa fa-support"></i><span
                            class="app-menu__label">Support</span></a></li>
        @endif
    </ul>
</aside>