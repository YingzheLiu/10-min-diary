@extends('layouts.main')

@section('title', 'To-Do')

@section('content')
    <div class="alert alert-warning" role="alert">
        Only the tasks posted today will appear here!
    </div>
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add a Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('todo.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="task" class="form-control" id="task" name="task">  
                        @error('task')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <form method="POST" action="{{ route('todo.update') }}">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                New Task
            </button>
           
        </div>
        @csrf
        @foreach($todos as $todo)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="todo" name="{{ $todo->id }}" {{ $todo->finished ? "checked" : "" }}>
                <label class="form-check-label" for="todo">
                    {{$todo->task}}
                </label>
            </div>
        @endforeach
    </form>
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

    <script>
        @error('task')
            var myModal = document.getElementById('myModal')
            $(document).ready(function(){
                $("#myModal").modal("show");
            });
        @enderror
        document.getElementById('todo').addEventListener('click', function(){
	        console.log('updateText executed')
        });
    </script>
@endsection
