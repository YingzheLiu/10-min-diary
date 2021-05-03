@extends('layouts.main')

@section('title')
    Editing diary
@endsection

@section('content')
    <form action="{{ route('diary.update', [ 'id' => $diary->id ]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="6">{{ old('content', $diary->content) }}</textarea>
            <div id="count">
                <span id="current_count">0</span>
                <span id="maximum_count">/ 100</span>
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
            var s = $(this).val();
            var wordCount = 0;
            s = s.replace(/(^\s*)|(\s*$)/gi,"");
	        s = s.replace(/[ ]{2,}/gi," ");
	        s = s.replace(/\n /,"\n");
            wordCount = s.split(' ').length;
            var current_count = $('#current_count');
            current_count.text(wordCount);     
        });
    </script>
@endsection