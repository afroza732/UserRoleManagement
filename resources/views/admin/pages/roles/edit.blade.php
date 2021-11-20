@extends('admin.master')
@section('title')
    Edit Role 
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
               Edit Role
               
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('roles.update',$role->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputRole" value="{{$role->name}}" type="text" name="name"/>
                       
                    </div>
                    <label for="inputRole" class="mb-3">Permission</label>
                    <div class="form-check">
                        <input type="checkbox" {{\App\Models\User::roleHasPermissions($role,$allPermissions) ? 'checked' : ''}} class="form-check-input" id="allCheck"  value="1">
                        <label class="form-check-label" for="allCheck">All</label><br>
                    </div>
                    <hr>

                    <div class="form-floating mb-3">
                        @php
                           $i = 0; 
                        @endphp
                        @foreach ($permissionGroups as $permissionGroup)
                        @php
                        $i++; 
                        $permissions = \App\Models\User::getpermissionsByGroupName($permissionGroup->name);
                        @endphp
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    
                                    <input type="checkbox" class="form-check-input" {{\App\Models\User::roleHasPermissions($role,$permissions) ? 'checked' : ''}} id="group{{$i}}" value="{{ $permissionGroup->name }}" onclick="checkPermissionByGroup('groupwiseCheck{{$i}}', this)">
                                    <label class="form-check-label" for="checkPermission">{{$permissionGroup->name}}</label><br>
                                </div>
                            </div>
                            <div class="col-9 groupwiseCheck{{$i}}">
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" onclick="checkSinglePermission('groupwiseCheck{{$i}}', 'group{{$i}}',{{count($permissions)}})" class="form-check-input" id="{{$permission->id}}" name="permissions[]" {{$role->hasPermissionTo($permission->name) ? 'checked' : ' '}} value="{{$permission->name}}">
                                        <label class="form-check-label" for="{{$permission->id}}">{{$permission->name}}</label><br>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                        <br>
                        @endforeach
                       
                    </div>
                    <div class="mt-4 mb-0">
                        <input type="submit" class="btn btn-sm btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('admin.pages.roles.partials.scripts')
@endsection
