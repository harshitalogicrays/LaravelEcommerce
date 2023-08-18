<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{session('message')}}

            </div>            
        @endif
       <div class="card">
        <div class="card-header">
            <h3>
                Category
                <a name="" id="" class="btn btn-primary text-white float-end" href="{{url('admin/category/create')}}" role="button">Add Category</a>
            </h3>
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories  as $c )
                    <tr class="">
                        <td scope="row">{{$c->id}}</td>
                        <td>{{$c->name}}</td>
                        <td>{{$c->description}}</td>
                        <td>
                            @if ($c->status=='0')
                                <span class="badge rounded-pill bg-primary">Active</span>
                            @else
                             <span class="badge rounded-pill bg-danger">Inactive</span>
                        @endif

                           </td>
                           <td>
                            <img src="{{asset($c->image)}}" class="img-fluid rounded" alt="">
                           </td>
                        <td>
                            <a type="button" class="btn btn-success me-2 btn-sm" href="{{url('admin/category/edit/'.$c->id)}}">Edit</a>
                            <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button" wire:click="deleteCategory({{$c->id}})">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
           </div>
                   
        </div>
        <div class="ms-4 me-4">
        {{ $categories->links('pagination::bootstrap-5'); }}
        </div>
       </div>
    </div>
</div> 