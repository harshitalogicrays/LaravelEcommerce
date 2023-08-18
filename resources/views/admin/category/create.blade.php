@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
           <div class="card">
            <div class="card-header">
                <h3>
                    Category
                    <a name="" id="" class="btn btn-danger text-white float-end" href="{{url('admin/category')}}" role="button">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('admin/category')}}" enctype="multipart/form-data">
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
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="" class="form-control"></textarea>
                <small id="helpId" class="text-danger">
                    @error('description')
                    {{$message}}
                @enderror
                </small>
              </div>
              <div class="mb-3">
                <label class="form-check-label float-start" for="">  status             
                </label>
                <input type="checkbox" class="ms-2" name="status">
              </div>
              <div class="mb-3">
                <label class="form-check-label" for="">Image             
                </label>
                <input type="file" class="form-control" name="image">
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