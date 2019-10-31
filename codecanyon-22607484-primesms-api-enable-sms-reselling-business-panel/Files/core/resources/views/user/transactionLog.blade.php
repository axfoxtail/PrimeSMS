@extends('user.layouts.master')
@section('page_icon', 'fa fa-bars')
@section('page_name', 'Transaction Log')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Recipient Bal</th>
                            <th>Sender</th>
                            <th>Sender Bal</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Trx</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    @if($item->to_add != 0)
                                     {{$item->to->username}}
                                    @else
                                        ADMIN
                                    @endif
                                </td>
                                <td>
                                    {{ $general->currency_symbol }} {{$item->to_add}}
                                </td>
                                <td>
                                    @if($item->from_add != 0)
                                    {{$item->from->username}}
                                    @else
                                        ADMIN
                                    @endif
                                </td>
                                <td>
                                    {{ $general->currency_symbol }} {{$item->from_add}}
                                </td>
                                <td>
                                    {{ $general->currency_symbol }} {{$item->amount}}
                                </td>
                                <td>
                                    @if($item->type == 1)
                                        <p class="badge badge-success">Balance Added</p>
                                    @elseif($item->type == 2)
                                        <p class="badge badge-danger">Balance Deducted</p>
                                    @elseif($item->type == 3)
                                        <p class="badge badge-info">SMS sent</p>
                                    @endif
                                </td>
                                <td>
                                    {{$item->trx}}
                                </td>
                                <td>
                                    {{ $item->created_at->format('d M Y - H:i') }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection