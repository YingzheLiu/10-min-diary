@extends('layouts.main')

@section('title')
    Edit Diary - {{$diary->created_at->format('m/d/y')}}
@endsection

@section('date')
    {{$diary->created_at->format('m/d/y')}}
@endsection

@section('content')
    <script>
        $(window).on('load', function () {
            const words = "{{ $diary->content }}".split(' ');
            if (words.length == 1 && !words[0]) {
                $('#current_count').text(0);
            }
            else {
                $('#current_count').text(words.length);
            }
        });
    </script>
    <form action="{{ route('diary.update', [ 'id' => $diary->id ]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="6">{{ old('content', $diary->content) }}</textarea>
            <div id="count">
                <span id="current_count"></span>
                <span id="maximum_current_countcount">/ 100</span>
                <span>words</span>
            </div>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            @foreach($emojiIcons as $emoji)
                <div class="form-check form-check-inline">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="emoji" 
                        id="{{$emoji->id}}" 
                        value="{{$emoji->id}}" 
                        {{ $emoji->id === (int) old('emoji', $diary->emoji_icon_id) ? "checked" : "" }}
                    >
                    <label class="form-check-label" for="inlineEmoji1">
                        <p style="font-size:50px">&#{{$emoji->ref}};</p>
                    </label>
                </div>
            @endforeach
            <div>
                @error('artist')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
    <script type="text/javascript">
        $('textarea').keyup(function() {          
            const words = $(this).val().split(' ');
            $('#current_count').text(words.length);
        });
    </script>
@endsection