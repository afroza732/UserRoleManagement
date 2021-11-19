@extends('admin.master')
@section('title')
    Create Role 
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="float-right pt-5">
            <a href="{{route('roles.index')}}" class="btn btn-primary">Role Lists</a>
        </div><br>
        @include('admin.partials.message')
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
               Create Role
               
            </div>
            <div class="card-body">
                <form method="post" action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputRole" type="text" name="name"/>
                        <label for="inputRole">Role Name</label>
                    </div>
                    <label for="inputRole" class="mb-3">Permission</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="allCheck"  value="1">
                        <label class="form-check-label" for="allCheck">All</label><br>
                    </div>
                    <hr>
                    <div class="form-floating mb-3">
                       @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{$permission->id}}" name="permissions[]" value="{{$permission->name}}">
                            <label class="form-check-label" for="{{$permission->id}}">{{$permission->name}}</label><br>
                        </div>
                       @endforeach
                    </div>
                    <div class="mt-4 mb-0">
                        <input type="submit" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function(){
        $('#allCheck').click(function(){
        if($(this).is(':checked')){
            $('input[type=checkbox]').prop('checked',true);
        }else{
            $('input[type=checkbox]').prop('checked',false);
        }
    });
    })
</script>
@endsection
