@extends('layouts.main')

@section('title', 'Diaries')

@section('content')
    <div class="alert alert-warning" role="alert">
        One diary per day!
    </div>
    <div class="text-end mb-3">
        <a href="{{ route('diary.create') }}" class="btn btn-success">New Diary</a>
    </div>
    @foreach($diaries as $diary)
        <div class="d-flex justify-content-center">
            <div class="row mb-3">
                <div class="card" style="width: 1300px;">
                    <div class="card-body">
                        <div class="card-title">
                            <h5 class="d-inline">{{$diary->created_at->format('m/d/Y')}}</h5>
                            <div style="font-size:40px; margin-left: 5px;" class="d-inline-block">
                                &#{{$diary->emojiIcon->ref}};
                            </div>
                        </div>
                        <p class="card-text">{{$diary->content}}</p>
                        <div class="text-end">
                            <a href="{{ route('diary.edit', [ 'id' => $diary->id ])}}" class="card-link">Edit</a>
                            <a href="{{ route('diary.deleteConfirmation', [ 'id' => $diary->id ]) }}" class="card-link">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
   
    <script>
        @if(Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}";
          switch(type){
              case 'info':
                  toastr.info("{{ Session::get('message') }}");
                  break;
              
              case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
      
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
      
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif
      </script>
@endsection