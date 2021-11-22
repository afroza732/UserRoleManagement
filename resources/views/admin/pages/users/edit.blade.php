@extends('admin.master')
@section('title')
    Edit User 
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="float-right pt-5">
            <a href="{{route('users.index')}}" class="btn btn-primary">User Lists</a>
        </div><br>
        @include('admin.partials.message')
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
               Edit User
               
            </div>
            <div class="card-body">
                <form method="post" action="{{route('users.update',$user->id)}}">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3 mb-md-0">
                                <label for="inputFirstName">Name</label>
                                <input class="form-control" id="inputFirstName" type="text" name="name" value="{{$user->name}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input class="form-control" id="inputEmail" type="email" name="email" value="{{$user->eamil}}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3 mb-md-0">
                                <label for="inputPassword">Password</label>
                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Enter your  name" />
                              
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPassword1">Confirm Password</label>
                                <input class="form-control" id="inputPassword1" type="Password" name="password_confirmation" placeholder="Enter your email" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group mb-3 mb-md-0">
                                <label for="inputPassword">Assign Roles</label>
                               <select class="form-control select2" name="roles[]" multiple>
                                    <option value="">Select roles</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->name}}" {{$user->hasRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>
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
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection
