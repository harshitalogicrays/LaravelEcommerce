@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
           <div class="card">
            <div class="card-header">
                <h3>
                    Add User
                    <a name="" id="" class="btn btn-primary text-white float-end" href="{{url('admin/users')}}" role="button">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('admin/user')}}" enctype="multipart/form-data">
                    @csrf
               <div class="mb-3">
                 <label for="" class="form-label">Name</label>
                 <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                 <small id="helpId" class="text-danger">
                    @error('name')
                        {{$message}}
                    @enderror
                 </small>
               </div>
               <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" name="email" id="" class="form-control" placeholder="">
                <small id="helpId" class="text-danger">
                    @error('email')
                    {{$message}}
                @enderror
                </small>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" id="" class="form-control" placeholder="">
                <small id="helpId" class="text-danger">
                    @error('password')
                    {{$message}}
                @enderror
                </small>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Role</label>
                <select name="role_as" class="form-select">
                    <option>select role</option>
                    <option value="1">Admin</option>
                    <option value='0'>User</option>
                </select>
                <small id="helpId" class="text-danger">
                    @error('role_as')
                    {{$message}}
                @enderror
                </small>
              </div>
              <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-primary text-white">Add</button>
              </div>
                </form>
            </div>
           </div>
        </div>
    </div>
@endsection

