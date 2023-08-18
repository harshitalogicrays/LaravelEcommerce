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
                <form method="post" action="{{url('admin/category/'.$category->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
               <div class="mb-3">
                 <label for="" class="form-label">Name</label>
                 <input type="text" name="name" id="" value={{$category->name}} class="form-control" placeholder="" aria-describedby="helpId">
                 <small id="helpId" class="text-danger">
                    @error('name')
                        {{$message}}
                    @enderror
                 </small>
               </div>
               <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="" class="form-control">{{$category->description}}</textarea>
                <small id="helpId" class="text-danger">
                    @error('description')
                    {{$message}}
                @enderror
                </small>
              </div>
              <div class="mb-3">
                <label class="form-check-label float-start" for="">  status             
                </label>
                <input type="checkbox" class="ms-2" name="status" {{$category->status=='0'?'checked':null}}>
              </div>
              <div class="mb-3">
                <label class="form-check-label" for="">Image             
                </label>
                <input type="file" class="form-control" name="image">
                <img src="{{asset($category->image)}}" class="img-fluid rounded" alt="" height='100px' width='100px'>
              </div>
              <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-primary text-white">Save</button>
              </div>
                </form>
            </div>
           </div>
        </div>
    </div>
@endsection