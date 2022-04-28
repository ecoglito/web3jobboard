@extends('layouts.main')
@section("title", "Companies")

@section("content")
<div class = "container">
        <div class = "row">
        <div class="col-lg-6 offset-lg-3">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <h2 class="mb-3 p-3 bg-green text-white">Companies</h2>
            <div class="d-flex justify-content-between align-items-center">
                <table class = "table">
                    <tr>
                        <th colspan="2">Company Name</th>
                
                    </tr>
                    
                    @foreach ($companies as $company)
                        <tr>
                            <td>
                                <a href="{{ route('companies.profile', [ 'id' => $company->id ]) }}">
                                {{$company->company}}</td>
                                </a>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (Auth::check() === true)
                <form action = "{{route('companies.add')}}"> 
                    <button class="btn bg-green" type="submit">
                        Add a new company!
                    </button>
                </form>
            @else
                <p>Please login to add a new company.
            @endif
        </div>
    </div>
</div>
@endsection