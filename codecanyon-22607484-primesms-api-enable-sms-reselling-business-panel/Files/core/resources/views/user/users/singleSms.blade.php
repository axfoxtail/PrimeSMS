@extends('user.layouts.master')
@section('page_icon', 'fa fa-bars')
@section('page_name')
    SMS Log of <b>{{ $user->username }}</b>
    @endsection
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Number</th>
                            <th scope="col">Status</th>
                            <th scope="col">Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $k=>$item)
                            <tr>
                                <td data-label="SL">{{++$k}}</td>
                                <td data-label="Amount">{{ $item->number  }}</td>
                                <td data-label="Amount">
                                    @if($item->status == 'success')
                                        <p class="badge badge-success">Success</p>
                                    @elseif($item->status == 'fail')
                                        <p class="badge badge-danger">failed</p>
                                    @endif
                                </td>
                                <td data-label="Time">{{ $item->created_at->format('d M Y - H:i A') }} </td>
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