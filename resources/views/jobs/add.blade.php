@extends('layouts.main')
@section("title", "Add a new job") 
@section("content")
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <h2 class="mb-3 p-3 bg-green text-white">Add a new job listing</h2>
            <form class="pb-3 border-bottom mb-3" action="{{ route('jobs.create')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <div>
                        <label for="role" class ="form-label">Role</label>
                        <input type="text" name="role" id="role" class="form-control" value="{{ old('role') }}">
                    </div>
                    @error('role')
                            <small class="text-danger">{{$message}}</small>
                    @enderror
                    
                    <div>
                    <label for="company" class ="form-label">Company</label>
                        <select name = "company" id = "company" class = "form-select"> 
                            <option value = ""> -- Select A Company -- </option>
                            @foreach($companies as $company)
                                <option value ="{{$company->id}}" {{ (string) $company->id === old('company') ? "selected" : "" }}>
                                    {{$company->company}}  
                                </option>
                            @endforeach    
                        </select>
                    </div>
                    @error('company')
                         <small class="text-danger">{{$message}}</small>
                     @enderror

                    <div>
                        <label for="salary" class ="form-label">Salary</label>
                        <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary') }}">
                    </div>
                    @error('salary')
                    <small class="text-danger">{{$message}}</small>
                    @enderror

                    <div>
                        <label for="location" class ="form-label">Location</label>
                        <input type="location" name="location" id="location" class="form-control" value="{{ old('location') }}">
                    </div>
                    @error('location')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button class="btn bg-green" type="submit">
                Add
                </button>
            </form>
        </div>
    </div>
</div>
@endsection