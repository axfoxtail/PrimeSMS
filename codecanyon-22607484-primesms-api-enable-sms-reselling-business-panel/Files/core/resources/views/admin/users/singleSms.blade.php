@extends('admin.layouts.master')
@section('page_icon', 'fa fa-history')
@section('page_name')
    SMS Logs of <b>{{ $user->username }}</b>
    @endsection
@section('body')
    <div class="tile">
        <h3 class="tile-title">SMS Logs</h3>
        <table class="table table-hover table-responsive-lg">
            <thead>
            <tr>
                <th>Number</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        {{$item->number}}
                    </td>
                    <td>
                        @if($item->status == 'success')
                            <p class="badge badge-success">Success</p>
                        @elseif($item->status == 'fail')
                            <p class="badge badge-danger">failed</p>
                        @endif
                    </td>
                    <td>
                        {{ $item->created_at->format('d M Y - H:i A') }}
                    </td>
                </tr>
            @endforeach
            <tbody>
        </table>
        <div class="d-flex justify-content-center">
        {{$items->links()}}
        </div>
    </div>
@endsection