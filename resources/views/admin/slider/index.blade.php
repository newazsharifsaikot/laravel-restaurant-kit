@extends("layouts.backend.master")

@section("title", "Slider")

@section("css")
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('admin.slider.create')}}" class="btn btn-primary btn-sm">
                    <i class="material-icons">add</i>
                    <span>Add Slider</span>
                </a>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">All Slide <span class="badge badge-pill">{{$sliders->count()}}</span> </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered"  id="example" style="width:100%">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Title</th>
                                        <th>Sub title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $key=>$slider)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$slider->title}}</td>
                                    <td>{{$slider->sub_title}}</td>
                                    <td>
                                        <img src="{{Storage::disk('public')->url('slider/'.$slider->image)}}" alt="img" width="80" height="60">
                                    </td>
                                    <td>
                                        @if($slider->status == true)
                                            <span class="btn btn-success btn-sm">Published</span>
                                        @else
                                            <span class="btn btn-danger btn-sm">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($slider->status == true)
                                            <a href="{{route('admin.slider.pending',$slider->id)}}" class="btn btn-warning btn-sm" title="un-publish">
                                                <i class="material-icons">clear</i>
                                            </a>
                                         @else
                                            <a href="{{route('admin.slider.publish',$slider->id)}}" class="btn btn-success btn-sm" title="publish">
                                                <i class="material-icons">done</i>
                                            </a>
                                         @endif

                                        <a href="{{route('admin.slider.edit',$slider->id)}}" class="btn btn-primary btn-sm" title="edit">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="deleteSlider({{$slider->id}})" title="delete">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-slider-{{$slider->id}}" action="{{route('admin.slider.destroy',$slider->id)}}" method="post" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("js")
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" ></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

        function deleteSlider(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-slider-'+id).submit()
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection