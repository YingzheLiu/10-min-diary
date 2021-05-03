@extends('layouts.main')

@section('title', 'New Diary')

@section('content')
    <script>
        $(window).on('load', function () {
            const words = "{{ old('content') }}".split(' ');
            console.log(words);
            if (words.length == 1 && !words[0]) {
                $('#current_count').text(0);
            }
            else {
                $('#current_count').text(words.length);
            }
        });
    </script>
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
            const words = $(this).val().split(' ');
            $('#current_count').text(words.length);
        });
        const startMinutes = 10;
        let time = startMinutes * 60
        const countdown = document.getElementById('countdown');
        var myTimer = setInterval(updateCountdown, 1000);
        function updateCountdown() {
            const minutes = Math.floor(time / 60);
            let seconds = time % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            countdown.innerHTML = `${minutes}: ${seconds}`;
            time--;
            if (time == -1) {
                clearInterval(myTimer);
            } 
        }
    </script>
@endsection