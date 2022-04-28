@extends('layouts.main')
@section("title", "Add a new job") 
@section("content")
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <h2 class="mb-3 p-3 bg-green text-white">Add a new company to the database</h2>
            <form class="pb-3 border-bottom mb-3" action="{{ route('companies.create')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <div>
                        <label for="company" class ="form-label">Company</label>
                        <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}">
                    </div>
                    @error('company')
                            <small class="text-danger">{{$message}}</small>
                    @enderror
                <button class="btn bg-green" type="submit">
                     Add
                </button>
            </form>
        </div>
    </div>
</div>
@endsection