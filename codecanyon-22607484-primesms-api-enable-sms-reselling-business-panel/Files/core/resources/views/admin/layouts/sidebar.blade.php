<aside class="app-sidebar">
    <ul class="app-menu">
        <li><a class="app-menu__item @if(request()->path() == 'admin/dashboard') active @endif"
               href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span
                        class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'admin/coverage') active @endif"
               href="{{ route('coverage') }}"><i class="app-menu__icon fa fa-wifi"></i><span
                        class="app-menu__label">Routing/Coverage</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'admin/smsGatewayList') active @endif"
               href="{{ route('sms.gateway.list') }}"><i class="app-menu__icon fa fa-envelope-open"></i><span
                        class="app-menu__label">SMS Gateways</span></a></li>
        <li class="treeview
@if(request()->path() == 'admin/users') is-expanded
@elseif(request()->path() == 'admin/user-banned') is-expanded
@elseif(request()->path() == 'admin/broadcast') is-expanded
@elseif(request()->path() == 'admin/subscribers') is-expanded
@elseif(request()->path() == 'admin/transactionLogs') is-expanded
@elseif(request()->path() == 'admin/smsLog') is-expanded
@endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span
                        class="app-menu__label">Users Management</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/users') active @endif"
                       href="{{ route('admin.users') }}"><i class="icon fa fa-circle-o"></i> Users</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/user-banned') active @endif"
                       href="{{ route('admin.user-ban') }}"><i class="icon fa fa-circle-o"></i> Banned users</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/broadcast') active @endif"
                       href="{{ route('admin.broadcast') }}"><i class="icon fa fa-circle-o"></i> Broadcast Mail</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/transactionLogs') active @endif"
                       href="{{ route('admin.transaction') }}"><i class="icon fa fa-circle-o"></i> Transaction Logs</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/smsLog') active @endif"
                       href="{{ route('admin.smsLog') }}"><i class="icon fa fa-circle-o"></i> SMS Logs</a>
                </li>
            </ul>
        </li>
        <li><a class="app-menu__item @if(request()->path() == 'admin/sendSMS') active @endif"
               href="{{ route('admin.send.sms') }}"><i class="app-menu__icon fa fa-envelope"></i><span
                        class="app-menu__label">Send SMS</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'admin/dbBackup') active @endif"
               href="{{ route('db.backup') }}"><i class="app-menu__icon fa fa-database"></i><span
                        class="app-menu__label">Database Backup</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'admin/plan') active @endif"
               href="{{ route('admin.plan') }}"><i class="app-menu__icon fa fa-tasks"></i><span
                        class="app-menu__label">Plans</span></a></li>
        <li class="treeview
@if(request()->path() == 'admin/supportTickets') is-expanded
@elseif(request()->path() == 'admin/pendingSupportTickets') is-expanded
@endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-ticket"></i><span
                        class="app-menu__label">Support Ticket</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/supportTickets') active @endif"
                       href="{{ route('admin.ticket') }}"><i class="icon fa fa-circle-o"></i> Support Tickets</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/pendingSupportTickets') active @endif"
                       href="{{ route('admin.pending.ticket') }}"><i class="icon fa fa-circle-o"></i> Pending
                        Tickets</a>
                </li>
            </ul>
        </li>
        <li class="treeview
@if(request()->path() == 'admin/generalSetting') is-expanded
@elseif(request()->path() == 'admin/emailSetting') is-expanded
@elseif(request()->path() == 'admin/smsSetting') is-expanded
@endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span
                        class="app-menu__label">Website Cotrol</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/generalSetting') active @endif"
                       href="{{ route('admin.GenSetting') }}"><i class="icon fa fa-circle-o"></i> General Settings</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/emailSetting') active @endif"
                       href="{{ route('admin.EmailSetting') }}"><i class="icon fa fa-circle-o"></i> Email Template</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/smsSetting') active @endif"
                       href="{{ route('admin.smsSetting') }}"><i class="icon fa fa-circle-o"></i> SMS Template</a>
                </li>
            </ul>
        </li>
        <li class="treeview
@if(request()->path() == 'admin/logoFaviconSettings') is-expanded
@elseif(request()->path() == 'admin/contactSetting') is-expanded
@endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-desktop"></i><span
                        class="app-menu__label">Interface Cotrol</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/logoFaviconSettings') active @endif"
                       href="{{ route('logoicon') }}"><i class="icon fa fa-circle-o"></i> Logo Icon Settings</a>
                </li>
                <li><a class="treeview-item @if(request()->path() == 'admin/contactSetting') active @endif"
                       href="{{ route('admin.contact') }}"><i class="icon fa fa-circle-o"></i> Contact Settings</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>