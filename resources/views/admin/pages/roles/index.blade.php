@extends('admin.master')
@section('title')
    Role List
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
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
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$role->name}}</td>
                            <td>-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection