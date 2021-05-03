@extends('layouts.main')

@section('title')
    Deleting {{ $diary->created_at }}
@endsection

@section('content')
    <form action="{{ route('diary.delete', [ 'id' => $diary->id ]) }}" method="POST">
        @csrf
        <p class="mt-3 mb-3">Are you sure you want to delete "{{$diary->created_at}}"?</p>
        <a href="{{ route('diary.index') }}" class="btn btn-primary" role="button">Cancel</a>
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </form>
@endsection