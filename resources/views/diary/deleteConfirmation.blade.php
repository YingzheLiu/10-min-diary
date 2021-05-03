@extends('layouts.main')

@section('title')
    Diaries - Delete Diary {{ $diary->created_at->format('m/d/Y') }}
@endsection

@section('date')
    {{$diary->created_at->format('m/d/y')}}
@endsection

@section('content')
    <form action="{{ route('diary.delete', [ 'id' => $diary->id ]) }}" method="POST">
        @csrf
        <p class="mt-3 mb-3">Are you sure you want to delete your diary written on <strong>{{$diary->created_at->format('m/d/Y')}}</strong>?</p>
        <div style="margin-top: 200px">
        <a href="{{ route('diary.index') }}" class="btn btn-primary" role="button">Cancel</a>
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </div>
    </form>
@endsection