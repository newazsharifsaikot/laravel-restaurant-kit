@extends("layouts.backend.master")

@section("title", "Contact")

@section("css")
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{$contact->subject}}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Name :</strong> {{$contact->name}}  </p>
                        <p><strong>Email :</strong> {{$contact->email}}  </p>
                        <p><strong>Message :</strong> {{$contact->message}}  </p>
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

        function deleteContact(id) {
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
                    document.getElementById('delete-contact-'+id).submit()
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