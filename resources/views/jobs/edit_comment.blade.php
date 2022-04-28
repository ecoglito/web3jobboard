@extends('layouts.main')
@section("title")
Edit {{$comment->body}}
@endsection
@section("content")
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

            <div>
                <form action="{{ route('jobs.update_comment', [ 'id' => $comment->id ]) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <div>
                            <label for="comment" class ="form-label">Comment</label>
                            <input type="text" name="comment" id="comment" class="form-control" value="{{  old('comment', $comment->body)  }}">
                        </div>
                        @error('comment')
                                <small class="text-danger">{{$message}}</small>
                        @enderror
                    <button class="btn bg-green" type="submit">
                    Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection