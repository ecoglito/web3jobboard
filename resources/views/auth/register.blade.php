@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <p>Already have an account? Please <a href="{{ route('login') }}">login</a>.</p>
            <form method="post" action="{{ route('registration.create') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <input type="submit" value="Register" class="btn bg-green">
            </form>
        </div>
    </div>
</div>
@endsection 