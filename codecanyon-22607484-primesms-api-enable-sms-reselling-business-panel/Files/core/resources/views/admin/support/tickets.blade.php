@extends('admin.layouts.master')
@section('page_icon', 'fa fa-ticket')
@section('page_name', 'Support Ticket')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Support Tickets</h3>
                <table class="table table-hover table-responsive-lg">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Ticket</th>
                        <th>Subject</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td><a href="{{ route('admin.user-single', $item->user_id) }}"> {{$item->user->username}}</a></td>
                            <td>{{ $item->ticket }} </td>
                            <td>{{ $item->subject }} </td>
                            <td>
                                @if($item->status == 0)
                                    <p class="btn badge-primary custom-btn-badge">Open</p>
                                @elseif($item->status == 1)
                                    <p class="btn badge-success custom-btn-badge">Answered</p>
                                @elseif($item->status == 2)
                                    <p class="btn badge-info custom-btn-badge">Customer Replied</p>
                                @elseif($item->status == 3)
                                    <p class="btn badge-danger custom-btn-badge">Closed</p>
                                    @endif
                            </td>
                            <td>{{ $item->created_at->format('d F, Y H:i A') }}</td>
                            <td>
                                <a href="{{ route('admin.ticket.reply', $item->id) }}" class="btn btn-outline-info"><i
                                            class="fa fa-eye"></i></a>
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
@endsection