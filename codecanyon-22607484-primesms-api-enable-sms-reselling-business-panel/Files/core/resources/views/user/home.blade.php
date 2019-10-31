@extends('user.layouts.master')
@section('page_icon', 'fa fa-dashboard')
@section('page_name', 'Dashboard')
@section('body')
    <div class="row">
        @if(Auth::user()->refer_by == 0 && Auth::user()->roll == 1)
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-shopping-basket fa-3x"></i>
                <div class="info">
                    <h4>Total Clients</h4>
                    <p><b>{{ $clients }}</b></p>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-6 @if(Auth::user()->refer_by == 0 && Auth::user()->roll == 1) col-lg-3 @else col-lg-6 @endif">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-exchange fa-3x"></i>
                <div class="info">
                    <h4>Total Transactions</h4>
                    <p><b>{{ $transaction }}</b></p>
                </div>
            </div>
        </div>
            @if(Auth::user()->refer_by == 0 && Auth::user()->roll == 1)
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-ticket fa-3x"></i>
                <div class="info">
                    <h4>Total Support</h4>
                    <p><b>{{ $support }}</b></p>
                </div>
            </div>
        </div>
            @endif
            <div class="col-md-6 @if(Auth::user()->refer_by == 0 && Auth::user()->roll == 1) col-lg-3 @else col-lg-6 @endif">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-envelope-open fa-3x"></i>
                    <div class="info">
                        <h4>Total sent SMS</h4>
                        <p><b>{{ $sms }}</b></p>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Monthly Send SMS Statistic</h3>
                    <div id="invoice-chart" class="mb16"></div>
            </div>
        </div>
        <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Recent 5 Transactions</h3>
                    <div class="tile-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Trx</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lastTransactions as $ltrans)
                                <tr>
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
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        var mt =  {!! $monthly_sms !!} ;
        new Morris.Bar({
            element: 'invoice-chart',
            data: mt,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Monthly sms send']
        });
    </script>
    @endsection