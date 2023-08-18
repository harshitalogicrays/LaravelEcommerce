@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
           <div class="card">
            <div class="card-header">
                <h3>
                    Edit Product
                    <a name="" id="" class="btn btn-danger text-white float-end" href="{{url('admin/products')}}" role="button">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('admin/products/'.$product->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">Image</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Category</label>
                                            <select name="category_id" class="form-select">
                                                <option selected disabled>select</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{$c->id==$product->category_id?"selected":null}}>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" id="" class="form-control" value={{$product->name}}
                                                placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Brand</label>
                                            <input type="text" name="brand" id="" class="form-control" value={{$product->brand}}
                                                placeholder="">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                <div class="tab-pane fade" id="details-tab-pane" role="tabpanel"
                                    aria-labelledby="details-tab" tabindex="0">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                          <div class="mb-3">
                                            <label for="" class="form-label">originial_price</label>
                                            <input type="number" name="originial_price" id="" class="form-control" value={{$product->originial_price}}
                                                placeholder="" aria-describedby="helpId">
                                        </div>
                                    <div class="mb-3">
                                            <label for="" class="form-label">selling_price</label>
                                            <input type="number" name="selling_price" id="" class="form-control" value={{$product->selling_price}}
                                                placeholder="" aria-describedby="helpId">
                                        </div>
                                      
                                        <div class="mb-3">
                                            <label for="" class="form-label">Quantity</label>
                                            <input type="number" name="qty" id="" class="form-control"
                                                placeholder=""  value={{$product->qty}}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea  name="descritpion" id="" class="form-control">{{$product->descritpion}}</textarea>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox"  name="status" {{$product->status=='0'?"checked":null}}>
                                          <label class="form-check-label" for="">
                                            Status
                                          </label>
                                        </div>
                                  </div>
                                </div>
                                    </div>
                                <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                                    tabindex="0">
                                    <div class="card mt-2">
                                      <div class="card-body">
                                        <div class="mb-3">
                                          <label for="" class="form-label">upload product images</label>
                                          <input type="file" class="form-control" multiple  name="image[]" id="" placeholder="" aria-describedby="fileHelpId">
                                        </div>
                                        <div>
                                            @if($product->productImages)
                                            @foreach ($product->productImages as $image)
                                             <img src="{{asset($image->image)}}" height="200px" width="200px" class="me-4 border"/>
                                             <a name="" id="" href="{{url('admin/product-image/delete/'.$image->id)}}" role="button"
                                             class="text-danger  text-decoration-none" style="position:relative;top:-90px;left:-32px;font-size:20px">X</a>
                                              @endforeach
                                            @else
                                             <h3>No Image found </h3>
                                            @endif
                                            </div>
                                            
                                        <input name="save" id="" class="btn btn-primary" type="submit" value="Save">
                                      </div>
                                    </div>
                                        
                                </div>
                                   
                            </div>
                       
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection