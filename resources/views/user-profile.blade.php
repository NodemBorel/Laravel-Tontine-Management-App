@extends('layouts.app')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4> Profile
            <a href="{{ url('/edit-profile') }}" class="btn btn-success float-end">Edit Profile</a>
            </h4>
        </div>
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                <strong>{{ session('status') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif 
        <div class="card-body">
            <div class="mb-3">
                <label for="">SOLDE</label>
                <p class="form-control">{{ $user->balance }} FCFA</p>
            </div>
            <div class="mb-3">
                <label for="">Full Name</label>
                <p class="form-control">{{ $user->name }}</p>
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <p class="form-control">{{ $user->email }}</p>
            </div>
            <div class="mb-3">
                <label for="">Role As</label>
                <p class="form-control">{{ $user->role_as == 1 ? 'Admin':'User' }}</p>
            </div>
            <div class="mb-3">
                <label for="">Created At</label>
                <p class="form-control">{{ $user->created_at->format('d/m/y') }}</p>
            </div>
            <div class="mb-3">
                <label for="">Update At</label>
                <p class="form-control">{{ $user->updated_at }}</p>
            </div>
        </div>
    </div>
</div>


@endsection