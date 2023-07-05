@extends('layouts.app')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4> Edit Profile
            <a href="{{ url('/user-profile') }}" class="btn btn-danger float-end">&nbsp &nbsp &nbsp Back &nbsp &nbsp &nbsp</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ url('/update-profile') }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">SOLDE</label>
                    <p class="form-control">{{ $user->balance }} FCFA</p>
                </div>
                <div class="mb-3">
                    <label for="">Full Name</label>
                    <input class="form-control" name="name" value="{{ $user->name }}">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input class="form-control" name="email" value="{{ $user->email }}">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">&nbsp; &nbsp; Submit &nbsp; &nbsp;</button>
                </div> 
            </form>    
        </div>
    </div>
</div>


@endsection