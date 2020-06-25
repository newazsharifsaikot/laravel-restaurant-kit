@extends("layouts.backend.master")

@section("title", "Category")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.category.update',$category->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Category Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}" autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" class="fill-in" name="status" value="1" {{$category->status == true ? 'checked' : ''}}> Publish
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{route('admin.category')}}" class="btn btn-danger btn-sm">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")

@endsection