@extends("layouts.backend.master")

@section("title", "Dashboard")

@section("css")
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">category</i>
                        </div>
                        <p class="card-category">category/item</p>
                        <h3 class="card-title">{{$category}}/{{$item}}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">warning</i>
                            <a href="javascript:;">Get More Space...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">slideshow</i>
                        </div>
                        <p class="card-category">slider</p>
                        <h3 class="card-title">{{$slider}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">weekend</i>
                        </div>
                        <p class="card-category">Reservation</p>
                        <h3 class="card-title">{{$reservation}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">local_offer</i> Tracked from Github
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <p class="card-category">Contact</p>
                        <h3 class="card-title">{{$contact}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">All Reservation <span class="badge badge-pill">{{$reservations->count()}}</span></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered"  id="example" style="width:100%">
                            <thead class=" text-primary">
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $key=>$reservation)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$reservation->name}}</td>
                                    <td>{{$reservation->email}}</td>
                                    <td>{{$reservation->phone}}</td>
                                    <td>{{$reservation->date_time}}</td>
                                    <td>{{$reservation->created_at->toDateString()}}</td>

                                    <td>
                                        @if($reservation->status == true)
                                            <span class="btn btn-success btn-sm">Confirmed</span>
                                        @else
                                            <span class="btn btn-danger btn-sm">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($reservation->status == true)
                                            <a href="{{route('admin.reservation.pending',$reservation->id)}}" class="btn btn-warning btn-sm" title="un-publish" onclick="return confirm('are you sure??'); ">
                                                <i class="material-icons">clear</i>
                                            </a>
                                        @else
                                            <a href="{{route('admin.reservation.publish',$reservation->id)}}" class="btn btn-success btn-sm" title="publish"  onclick="return confirm('are you sure??'); ">
                                                <i class="material-icons">done</i>
                                            </a>
                                        @endif
                                        <button class="btn btn-danger btn-sm" onclick="deleteReseve({{$reservation->id}})" title="delete">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-reservation-{{$reservation->id}}" action="{{route('admin.reservation.destroy',$reservation->id)}}" method="post" style="display: none;">
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
@endsection

@section("js")
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" ></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

        function deleteReseve(id) {
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
                    document.getElementById('delete-reservation-'+id).submit()
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