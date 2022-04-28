@extends('layouts.main')

@section("title")
    Company: {{ $company->company }}

    @endsection
    
@section("content")
<div class = "container">
        <div class = "row">
        <div class="col-lg-6 offset-lg-3">
            <h2 class="mb-3 p-3 bg-green text-white">{{$company->company}}</h2>
            <div class="d-flex justify-content-between align-items-center">
                @if (count($jobs) < 1)
                        <p>No jobs yet! Be the first to add a new job. </p>
                @else
                    <table class = "table">
                        <tr>
                            <th>Jobs</th>
                            <th colspan="2">Company</th>
                        </tr>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td><a href="{{ route('jobs.comment', [ 'id' => $job->id ]) }}">{{$job->body}}</a></td> 
                                    <td>{{$job->company->company}}</td>
                                </tr>
                            @endforeach
                    </table>
            </div>
                    @endif
            @if (Auth::check())
                <form action = "{{route('jobs.add')}}"> 
                    <button class="btn bg-green" type="submit">
                        Add a new job!
                    </button>
                </form>
            @else
                <p>Please login to add a new job.
            @endif
        </div>
    </div>
</div>
@endsection