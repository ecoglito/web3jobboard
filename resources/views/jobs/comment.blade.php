@extends('layouts.main')
@section("title")
{{$job->body}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @elseif (session('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <h2 class="mb-3 p-3 bg-green text-white">  {{$job->body}} </a> </h2>
                
                
                @if (Auth::check() === false)
                    <p>Please login to see comments.
                @elseif (count($comments) < 1)
                    <p>No comments yet! be the first to comment by using the form below. </p>
                @else
                    @foreach($comments as $comment)
                    <div>
                        <h4> {{$comment->body}} </h4>
                        <div class="border-bottom mt-3 pb-3 mb-3">
                            <em>
                                Posted on {{date_format($comment->created_at, 'n/j/Y')}} at {{date_format($comment->created_at, 'g:i A')}} by {{$comment->user->name}}
                            </em>
                        @if (Auth::id() === $comment->user->id)
                            <div class = "horizontal-row">
                                <form method="GET" action="{{ route('jobs.edit_comment', ['id' => $comment->id])}}">
                                    @csrf
                                    <button type="submit" class ="btn bg-primary">Edit</button>
                                </form>
                               
                        
                                <form method="POST" action="{{ route('jobs.delete_comment', ['id' => $comment->id])}}">
                                    @csrf
                                    <button type="submit" class ="btn bg-danger">Remove</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                
      
                    <form class="mt-3" method = "post" action = "{{ route('jobs.create_comment', [ 'id' => $job->id]) }}">
                        @csrf
                        <div class="form-group mb-3">
                            <textarea
                                name="comment"
                                class="form-control"></textarea>
                            @error('answer')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button class="btn bg-green" type="submit">
                            Add comment
                        </button>
                    </form>
                @endif
                </div>
            </div>
        </div>
        
    </div>
@endsection