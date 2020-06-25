@extends("layouts.backend.master")

@section("title", "Item")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add New Item</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.item.update',$item->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select  name="category" class="form-control @error('category') is-invalid @enderror">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $item->category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Item Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$item->name}}" autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Item Price</label>
                                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$item->price}}" autocomplete="price" autofocus>
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <div class="form-group">
                                            <label class="bmd-label-floating">Item Description</label>
                                            <textarea rows="5" class="form-control @error('description') is-invalid @enderror" name="description" autofocus>{{$item->description}}
                                            </textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <img src="{{Storage::disk('public')->url('item/'.$item->image)}}" alt="item-image" class="img-responsive img-thumbnail" width="220" height="180">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" class="fill-in" name="status" value="1" {{$item->status == true ? 'checked' : ''}}> Publish
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{route('admin.slider')}}" class="btn btn-danger btn-sm">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")

@endsection