@extends('admin.master')
@section('title')
    User List
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        @include('admin.partials.message')
        <div class="float-right pt-5">
            <a href="{{route('users.create')}}" class="btn btn-primary">+Create User</a>
        </div><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                User Lists
               
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">Sl</th>
                            <th width="10%">Name</th>
                            <th width="10%">Email</th>
                            <th width="45%">Roles</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge badge-info mr-1">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                                <a class="btn btn-danger text-white" href="{{ route('users.destroy', $user->id) }}"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                        Delete
                                    </a>

                                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
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