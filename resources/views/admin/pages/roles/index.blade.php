@extends('admin.master')
@section('title')
    Role List
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        @include('admin.partials.message')
        <div class="float-right pt-5">
            <a href="{{route('roles.create')}}" class="btn btn-primary">+Create Role</a>
        </div><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Role Lists
               
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">Sl</th>
                            <th width="10%">Name</th>
                            <th width="60%">Permissions</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                @foreach ($role->permissions as $perm)
                                    <span class="badge badge-info mr-1">
                                        {{ $perm->name }}
                                    </span>
                                @endforeach
                            <td>
                                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-primary">Edit</a>
                                <a class="btn btn-danger text-white" href="{{ route('roles.destroy', $role->id) }}"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                        Delete
                                    </a>

                                    <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection