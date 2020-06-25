@extends("layouts.backend.master")

@section("title", "Slider")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Edit Slider</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.slider.update',$slider->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$slider->title}}" autocomplete="title" autofocus>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Sub title</label>
                                            <textarea  name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" rows="5" autofocus>{{$slider->sub_title}}</textarea>
                                            @error('sub_title')
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
                                    <img src="{{Storage::disk('public')->url('slider/'.$slider->image)}}" alt="" class="img-responsive img-thumbnail" width="200px" height="180px">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" class="fill-in" name="status" value="1" {{$slider->status == true ? 'checked' : ''}}> Publish
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