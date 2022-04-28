@extends('layouts.main')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            @if (session('success'))
                    <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                    </div>
                @endif
            <p>Hello, {{ $user->name }}. Your email is {{ $user->email }}.</p>
        
            @if (count($favorites) < 1)
                <p>No favorites yet! check out a couple jobs and add them to your favorite list. </p>
            @else
                <h2 class="mb-3 p-3 bg-green text-white">Favorites</h2>
                <table class = "table">
                    <tr>
                        <th>Jobs</th>
                        <th>Company</th>
                        <th>Remove</th>
                    </tr>
                        @foreach ($favorites as $favorite)
                            <tr>
                                <td><a href="{{ route('jobs.comment', [ 'id' => $favorite->job->id]) }}">{{$favorite->job->body}}</a></td> 
                                <td><a href="{{ route('companies.profile', [ 'id' => $favorite->job->company->id]) }}">{{$favorite->job->company->company}}</td>
                                <td>
                                    <form method="POST" action="{{ route('jobs.remove_favorite', ['id' => $favorite->job->id])}}">
                                        @csrf
                                        <button type="submit">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                </table>
            @endif
        </div>
    </div>
</div>
@endsection 