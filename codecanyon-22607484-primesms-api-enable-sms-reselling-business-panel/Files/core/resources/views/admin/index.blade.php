@extends('admin.layouts.master')
@section('page_icon', 'fa fa-dashboard')
@section('page_name', 'Dashboard')
@section('body')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{ $users }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-support fa-3x"></i>
                <div class="info">
                    <h4>Active Tickets</h4>
                    <p><b>{{ $supports }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-wifi fa-3x"></i>
                <div class="info">
                    <h4>Active Routes</h4>
                    <p><b>{{ $routes }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-exchange fa-3x"></i>
                <div class="info">
                    <h4>Active Gateways</h4>
                    <p><b>{{ $gateways }}</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Monthly Transactions</h3>
                <div id="month-trans"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Monthly SMS send</h3>
                <div id="month-sms"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Recent 5 Transactions</h3>
                <div class="tile-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Sender</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Trx</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lastTransactions as $ltrans)
                            <tr>
                                <td>{{ $ltrans->to_add != 0 ? $ltrans->to->username : 'Admin' }}</td>
                                <td>{{ $ltrans->from_add != 0 ? $ltrans->from->username : 'Admin' }}</td>
                                <td>{{ $general->currency_symbol }} {{ $ltrans->amount}}</td>
                                <td>
                                    @if($ltrans->type == 1)
                                        <p class="badge badge-success">Balance Added</p>
                                    @elseif($ltrans->type == 2)
                                        <p class="badge badge-danger">Balance Deducted</p>
                                    @elseif($ltrans->type == 3)
                                        <p class="badge badge-info">SMS sent</p>
                                    @endif
                                </td>
                                <td>{{ $ltrans->trx }}</td>
                                <td>{{ $ltrans->created_at->format('d M, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Recent 5 Support Tickets</h3>
                <div class="tile-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Ticket</th>
                            <th>Sub</th>
                            <th>status</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lastsupports as $lticket)
                        <tr>
                            <td>{{$lticket->user->username}}</td>
                            <td>{{ $lticket->ticket }} </td>
                            <td>{{ $lticket->subject }} </td>
                            <td>
                                @if($lticket->status == 0)
                                    <p class="badge badge-primary">Open</p>
                                @elseif($lticket->status == 1)
                                    <p class="badge badge-success">Answered</p>
                                @elseif($lticket->status == 2)
                                    <p class="badge badge-info">Customer Replied</p>
                                @elseif($lticket->status == 3)
                                    <p class="badge badge-danger">Closed</p>
                                @endif
                            </td>
                            <td>{{ $lticket->created_at->format('d M, Y') }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var mt =  {!! $monthly_trans !!} ;
            new Morris.Bar({
                element: 'month-trans',
                data: mt,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Monthly Transactions']
            });
            var ms =  {!! $monthly_sms !!} ;
            Morris.Donut({
                element: 'month-sms',
                data: ms
            });
        });

    </script>
@endsection