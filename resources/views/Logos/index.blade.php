@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tenant Logos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tenant Logos</li>
            
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('shop_logos/create') }}">Upload Logo<i
                    class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive p-3">
            
                <table class="table align-items-center table-flush" id="logoTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($Logos as $logo)
                        
                        <tr>
                            
                            <td>{{ $logo->name }}</td>
                           
                            <td>{{ $logo->slug }}</td>

                            <td>
                                <img src="{{ $logo->image ? asset('logos/'. $logo->image) : "http://via.placeholder.com/150X150" }}"
                                    class="img-responsive img-fluid" />
                            </td>
                            <td>

                                <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('shop_logos/'.$logo->id.'/edit ') }}" data-logoEdit="{{ $logo->id }}">Edit</a>

                                <a class="btn btn-sm btn-danger" id="logoDelete" href="javascript:void(0);" data-logo-delete="{{ $logo->id }}">Delete</a>

                            </td>
                        </tr>

                    @endforeach
                    


                    </tbody>
                    <tfoot class="thead-light">
                        
                    </tfoot>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

   
    <!-- Modal Logout -->
    <div class="modal fade" id="viewlogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">View Cover Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){

            $(document).ready( function () {
                $('#logoTable').DataTable();
            } );
          
            $('#logoTable').on('click','#showImage', function (){

                var logoId = $(this).data('logo');


                $.ajax({
                    type: "GET",
                    url: "logo/" + logoId,
                    success: function(result) {
                        console.log(result);

                        $('#viewlogo').modal('show');

                        var image = '<img class="image" src="/images/'+ result.image +'" width="100%" height="90%" />';

                        $(image).insertAfter('.row:last');


                    }
                });
            });

            // remove the image from the modal
            $('#viewlogo').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.image').remove();
            });

            //delete 
            $('#logoTable').on('click','#logoDelete', function (){

                var logoDelete = $(this).data('logo-delete');
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    type: "DELETE",
                    url: "shop_logos/" + logoDelete,
                    data: {
                        "id": logoDelete,
                        "_token": token,
                    },
                    success: function(result) {
                        console.log(result);
                        alert('Deleted Successfully');

                        setInterval(() => {
                            location.reload();
                        }, 500);

                    }
                });
            });

        });
    </script>

@endsection