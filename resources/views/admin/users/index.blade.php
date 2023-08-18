@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('message') }}

                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>
                        All Users
                        <a name="" id="" class="btn btn-primary text-white float-end"
                            href="{{ url('admin/user/create') }}" role="button">Add User</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }} </td>
                                        <td>
                                            @if ($user->role_as == '1')
                                                <span class="badge bg-primary">Admin</span>
                                            @else
                                                <span class="badge bg-info">User</span>
                                            @endif


                                        </td>
                                        <td>
                                           <a name="" id="" class="btn btn-danger btn-sm"
                                                href="{{ url('admin/user/delete/' . $user->id) }}" role="button"
                                                onclick="return confirm('are you sure to delete??')">delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No User
										Available</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
    @endsection