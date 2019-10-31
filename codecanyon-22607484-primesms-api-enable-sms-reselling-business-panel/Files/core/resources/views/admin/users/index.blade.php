@extends('admin.layouts.master')
@section('page_icon', 'fa fa-users')
@section('page_name', 'Users List')
@section('body')
    <div class="tile">
        <div class="app-search float-right">
            <form method="POST" action="{{ route('admin.search-users') }}">
                @csrf
                <input type="search" name="search" class="app-search__input" style="background:#ddd;"
                       placeholder="Search User">
                <button class="app-search__button" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <h3 class="tile-title">Users List</h3>
        <table class="table table-hover table-responsive-lg">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Phone</th>
                <th>User type</th>
                <th>Reseller</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{$user->username}}
                    </td>
                    <td>
                        {{$user->mobile}}
                    </td>
                    <td>
                        {!!  $user->roll == 0? 'User' : '<b>Reseller</b>' !!}
                    </td>
                    <td>
                        @if($user->refer_by == 0)
                            {{ $general->title }}
                        @else
                            <a href="{{ route("admin.user-single", $user->refer_by) }}">{{ \App\User::where('id', $user->refer_by)->value('username') }}</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.user-single', $user->id)}}" class="btn btn-outline-info">
                            <i class="fa fa-eye"></i> View</a>
                        @if($user->roll == 0 && $user->refer_by == 0)
                        <button class="btn btn-outline-secondary mark-reseller" data-toggle="modal"
                                data-target="#markAsReseller"
                                data-route="{{ route('admin.user-roll', $user->id) }}">
                            <i class="fa fa-check"></i> Mark As Reseller
                        </button>
                            @endif
                    </td>
                </tr>
            @endforeach
            <tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div>
    </div>
    <div class="modal fade" id="markAsReseller" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation!</strong> </h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure want to make this user as reseller?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="" id="resellModal">
                        @csrf
                        @method('PUT')
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary custom-btn-background" name="replayTicket" value="2"><i class="fa fa-check"></i> Yes I'm Sure.</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.mark-reseller', function () {
                var route = $(this).data('route');
                $('#resellModal').attr('action', route);
            });
        });
    </script>
@endsection