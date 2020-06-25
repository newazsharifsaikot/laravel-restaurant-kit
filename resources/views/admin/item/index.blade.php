@extends("layouts.backend.master")

@section("title", "Item")

@section("css")
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('admin.item.create')}}" class="btn btn-primary btn-sm">
                    <i class="material-icons">add</i>
                    <span>Add New Item</span>
                </a>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">All Items <span class="badge badge-pill">{{$items->count()}}</span> </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered"  id="example" style="width:100%">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Category</th>
                                        <th>Item Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{Str::limit($item->description,25)}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        <img src="{{Storage::disk('public')->url('item/'.$item->image)}}" alt="img" width="80" height="60">
                                    </td>
                                    <td>
                                        @if($item->status == true)
                                            <span class="btn btn-success btn-sm">Published</span>
                                        @else
                                            <span class="btn btn-danger btn-sm">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == true)
                                            <a href="{{route('admin.item.pending',$item->id)}}" class="btn btn-warning btn-sm" title="un-publish">
                                                <i class="material-icons">clear</i>
                                            </a>
                                         @else
                                            <a href="{{route('admin.item.publish',$item->id)}}" class="btn btn-success btn-sm" title="publish">
                                                <i class="material-icons">done</i>
                                            </a>
                                         @endif

                                        <a href="{{route('admin.item.edit',$item->id)}}" class="btn btn-primary btn-sm" title="edit">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="deleteItem({{$item->id}})" title="delete">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-item-{{$item->id}}" action="{{route('admin.item.destroy',$item->id)}}" method="post" style="display: none;">
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

        function deleteItem(id) {
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
                    document.getElementById('delete-item-'+id).submit()
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