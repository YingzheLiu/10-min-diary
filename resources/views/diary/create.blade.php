@extends('layouts.main')

@section('title', 'New Diary')

@section('content')
    <div id="countdown" class="text-white float-right" style="margin-left: 1195px"></div>
    <form action="{{ route('diary.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="6">{{ old('content') }}</textarea>
            <div id="count">
                <span id="current_count">0</span>
                <span id="maximum_count">/ 100</span>
                <span>words</span>
            </div>
            {{-- <span id="cd-days">00</span> Days 
            <span id="cd-hours">00</span> Hours
            <span id="cd-minutes">00</span> Minutes
            <span id="cd-seconds">00</span> Seconds --}}
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            @foreach($emojis as $emoji)
                <div class="form-check form-check-inline">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="emoji" 
                        id="{{$emoji->id}}" 
                        value="{{$emoji->id}}" 
                        {{ (string) $emoji->id === old('emoji') ? "checked" : "" }}
                    >
                    <label class="form-check-label" for="inlineEmoji1">
                        <p style="font-size:50px">&#{{$emoji->ref}};</p>
                    </label>
                </div>
            @endforeach
            <div>
                @error('emoji')
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
        const startMinutes = 10;
        let time = startMinutes * 60
        const countdown = document.getElementById('countdown');
        setInterval(updateCountdown, 1000);
        function updateCountdown() {
            const minutes = Math.floor(time / 60);
            let seconds = time % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            //minutes = minutes < 10 ? '0' + minutes : minutes;
            countdown.innerHTML = `${minutes}: ${seconds}`;
            time--;
        }
    </script>
@endsection