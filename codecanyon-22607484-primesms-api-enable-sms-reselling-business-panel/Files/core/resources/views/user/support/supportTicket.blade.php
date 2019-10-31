@extends('user.layouts.master')
@section('page_icon', 'fa fa-support')
@section('page_name', 'Support')
@section('body')
    <div class="row">
        <div class="col-md-12">
            @include('user.layouts.flash')
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="admin-header-text">
                                <h4>My Support Tickets</h4>
                            </div>
                        </div>
                        <div class="col-md-6"> <span class="pull-right"> <div
                                        class="admin-header-button support-btn">
                        <a href="{{ route('user.ticket.open') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Open New Support Ticket</a>
                    </div> </span></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-lg">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Ticket Number</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supports as $key => $support)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $support->created_at->format('d F, Y h:i A') }}</td>
                                <td>#{{ $support->ticket }}</td>
                                <td>{{ $support->subject }}</td>
                                <td>
                                    @if($support->status == 0)
                                        <b class="btn badge-primary custom-btn-badge">Open</b>
                                    @elseif($support->status == 1)
                                        <b class="btn badge-success custom-btn-badge"> Answered</b>
                                    @elseif($support->status == 2)
                                        <b class="btn badge-info custom-btn-badge"> Customer Replied</b>
                                    @elseif($support->status == 3)
                                        <b class="btn badge-danger custom-btn-badge">Closed</b>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.message', $support->ticket) }}" class="btn btn-info"><i
                                                class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $supports->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection