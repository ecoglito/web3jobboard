@extends('layouts.main')
@section("title")
Edit {{$job->body}}
@endsection

@section("content")
@if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
@elseif (session('error'))
        <div class="alert alert-error" role="alert">
            {{ session('error') }}
        </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
                <form action="{{ route('jobs.update', [ 'id' => $job->id ]) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <div>
                            <label for="role" class ="form-label">Role</label>
                            <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $job->body) }}">
                        </div>
                        @error('role')
                                <small class="text-danger">{{$message}}</small>
                        @enderror
                        
                        <div>
                        <label for="company" class ="form-label">Company</label>
                            <select name = "company" id = "company" class = "form-select"> 
                                <option value = "{{$job->company->id}}"> {{$job->company->company}} </option>
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
                            <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
                        </div>
                        @error('salary')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <div>
                            <label for="location" class ="form-label">Location</label>
                            <input type="location" name="location" id="location" class="form-control" value="{{ old('location', $job->location) }}">
                        </div>
                        @error('location')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button class="btn bg-green" type="submit">
                    Update
                    </button>
                </form>
                <form action = " {{route('jobs.delete_job', ['id' => $job->id]) }}" method ="POST">
                    @csrf
                    <button class = "btn bg-danger" type = "submit">Delete </button>
                </form>
        </div>
    </div>
</div>

                        
                    
@endsection 