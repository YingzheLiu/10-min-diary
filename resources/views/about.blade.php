@extends('layouts.main')

@section('title')
    About
@endsection

@section('content')
    <p> 
        A couple of years ago, I accidentally found my diaries that I wrote when I was little at home. 
        It was very interesting to recall what happended back then and how much I have growed up. 
        The goal of this app is to encourage people to write a diary everyday.
        I know everyone is very busy nowadays. 
        But it just takes 10 mins in a day to document the most important things happen.       
    </p>
    <p>
        Let's record what things happen and how you are feeling every day.
        I am sure it will be fun to read in the future.
    </p>
    <p style="text-align: right">
        - Nikki
    </p>
    <h4>Comments</h4>
    @if ($total === 0)
        <p>No comments yet! Be the first to comment by using the form below.</p>
    @else
        <hr></hr>
        @foreach($comments as $comment)
            <div class="row">
                <div class="col-1">
                    <h5 class="text-primary"><strong>{{$comment->user->name}}</strong></h5> 
                </div>
                <div class="col">
                    <em class="text-muted">
                        - Posted on {{$comment->created_at}}
                    </em>
                </div>
                <p>
                    {{$comment->body}}
                </p>
            </div>
            <hr class="mt-1"></hr>
        @endforeach
    @endif
    <h4>
        Add Comments
    </h4>
    @if (Auth::check())
    <form
    class="mt-3"
    action="{{ route('comment.store') }}"
    method="POST">
        @csrf
        <div class="form-group">
            <textarea name="comment" class="form-control">{{old('comment')}}</textarea>
            @error('comment')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="text-right mt-3">
            <button class="btn btn-primary" type="submit">
                Post
            </button>
        </div>
    </form>
    @else
        <p>Sign in to add comments</p>
    @endif
@endsection