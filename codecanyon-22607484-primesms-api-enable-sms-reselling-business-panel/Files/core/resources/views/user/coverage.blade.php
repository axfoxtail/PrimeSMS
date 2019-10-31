@extends('user.layouts.master')
@section('page_icon', 'fa fa-wifi')
@section('page_name', 'Coverage List')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th>Country</th>
                            <th>Code</th>
                            <th>SMS Charge</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    {{ $item->country }}
                                </td>
                                <td>
                                    {{ $item->code }}
                                </td>
                                <td>
                                    {{ $general->currency_symbol }} {{isset($item->sms_charge) ? $item->sms_charge : $general->sms_charge}}
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