@extends('layouts.master')

@section('title', 'Payment Done')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
    <div class="card-header">
        <h4> Paid Users</h4>
    </div>
    <div class="card-body">
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif    
        <table id="myDataTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role As</th>
                    <th>Session Number</th>
                    <th>Amount</th>
                    <th>Time</th>                  
                </tr>
            </thead>
            <tbody>
                @foreach($payment as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->users->name }}</td>
                        <td>{{ $user->users->role_as == '1' ? 'Admin':'User' }}</td>
                        <td>{{ $user->sessions->id }}</td>
                        <td>{{ $user->amount }}</td>
                        <td>{{ $user->created_at }}</td>                 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
  </div>   
</div>

@endsection