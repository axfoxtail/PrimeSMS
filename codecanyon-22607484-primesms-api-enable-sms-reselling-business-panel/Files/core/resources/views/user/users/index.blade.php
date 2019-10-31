@extends('user.layouts.master')
@section('page_icon', 'fa fa-users')
@section('page_name', 'Users List')
@section('body')
    <div class="tile">
        <div class="app-search float-right">
            <form method="POST" action="{{ route('search.clients') }}">
                @csrf
                <input type="search" name="search" class="app-search__input" style="background:#ddd;" placeholder="Search User">
                <button class="app-search__button" type="submit"> <i class="fa fa-search"></i></button>
            </form>
        </div>
        <h3 class="tile-title">Users List</h3>
        <table class="table table-hover table-responsive-lg">
            <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>SMS Balance</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->username}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{$user->mobile}}
                    </td>
                    <td>
                        {{$user->sms}}
                    </td>
                    <td>
                        <a href="{{ route('client.details', $user->id) }}" class="btn btn-outline-info">
                            <i class="fa fa-eye"></i> </a>
                    </td>
                </tr>
            @endforeach
            <tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div>
    </div>
@endsection