@extends('layouts.main')
@section("title", "Home - Web3 Jobs Database")

@section("content")



<div class = "container"> 
        <div class = "row">
            <div class="col-lg-6 offset-lg-3">
               
                <h2 class="mb-3 p-3 text-white bg-green">Job Listings For Web3</h2>
                <div class="d-flex justify-content-between align-items-center">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-error" role="alert">
                        {{ session('error') }}
                        </div>
                    @endif

                    <table class = "table">
                        <tr>
                            <th>Jobs</th>
                            <th>Company</th>
                            <th>Salary</th>
                            <th>Location</th>
                           
                            <th> Edit </th>
                            @if (Auth::check())
                            
                            <th>Favorite?</th>
                            @endif

                        </tr>
                        @foreach ($jobs as $job)
                            <tr>
                                <td><a href="{{ route('jobs.comment', [ 'id' => $job->id ]) }}" >{{$job->body}}</a></td> 
                                <td><a href ="{{route('companies.profile', [ 'id' => $job->company ])}}"> {{$job->company->company}} </a></td>
                                <td>{{$job->salary}}</td>
                                <td>{{$job->location}}</td>
                                @if (Auth::id() === $job->user_id)
                                    <td><a href = "{{route("jobs.edit", ['id' => $job->id]) }}"> <p> Edit </p> </a></td>
                                @else
                                     <td>&nbsp;</td>
                                @endif
                                @if (Auth::check())
                                    <td>
                                        <form method="POST" action="{{ route('jobs.add_favorite', ['id' => $job->id])}}">
                                            @csrf
                                            <button type="submit" class = "btn bg-success">Favorite</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
                @if (Auth::check())
                    <form action = "{{route('jobs.add')}}"> 
                        <button class="btn bg-green" type="submit">
                            Add a new job!
                        </button>
                    </form>
                @endif
            </div>
        </div>
</div>
@endsection