@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" 
                integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" 
                crossorigin="anonymous" referrerpolicy="no-referrer" />

                <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">


@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Portfolio</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                <div>
                    <a class="m-0 float-left mr-2 btn btn-info btn-sm" href="{{ url('properties_sortable') }}">Sort Properties</a>
                 
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('properties/create') }}">Add New <i
                        class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="table-responsive p-3" >
         
                <table class="table align-items-center table-flush" id="propertyTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Pronvice</th>
                        <th>Banner Image</th>
                        <th>Cover Image</th>
                        <th>Featured</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($properties as $property)
                        <tr>
                            <td>
                                {{ $property->name }}
                            </td>
            
                            <td>
                                @foreach($pronvices as $pronvice)
                                   
                                    @if($pronvice->id === $property->pronvice_id)
                                        {{ $pronvice->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ asset('banner_images/'. $property->banner_image) }}" data-toggle="lightbox" data-gallery="img-gallery">
                                    <img class="img-responsive" src="{{ $property->banner_image ? asset('banner_images/'. $property->banner_image) : "http://via.placeholder.com/150X150" }}"
                                    style="width: 100px; height: 60px;" />
                                </a>
                                
                            </td>
                          
                            <td>
                                <a href="{{ asset('cover_images/'. $property->cover_image) }}" data-toggle="lightbox" data-gallery="img-gallery">
                                    <img class="img-responsive" src="{{ $property->cover_image ? asset('cover_images/'. $property->cover_image) : "http://via.placeholder.com/150X150" }}"
                                        style="width: 100px; height: 60px;" />
                                </a>
                            </td>

                            <td>
                                @if ($property->featured)
                                   <span class="badge badge-success">Featured</span>
                                @else
                                   <span class="badge badge-secondary">Not featured</span>
                                @endif
                            </td>
                            
                            <td>

                                <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('properties/'.$property->id.'/edit') }}" data-propertyEdit="{{ $property->id }}">Edit</a>

                                <a class="btn btn-sm btn-danger" id="propertyDelete" href="javascript:void(0);" data-property-delete="{{ $property->id }}">Delete</a>

                                

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
    <div class="modal fade" id="viewproperty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">View Image/PDF</h5>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" 
            integrity="sha512-YibiFIKqwi6sZFfPm5HNHQYemJwFbyyYHjrr3UT+VobMt/YBo1kBxgui5RWc4C3B4RJMYCdCAJkbXHt+irKfSA==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
    </script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
            //load the dataTable
            $('#propertyTable').DataTable();

            $('#propertyTable').on('click','#showImage', function (){
                var propertyId = $(this).data('property');
                $.ajax({
                    type: "GET",
                    url: "properties/" + propertyId,
                    success: function(result) {
                        console.log(result);
                        $('#viewProperty').modal('show');
                        var image = '<img class="image" src="/logos/'+ result.logo +'" width="100%" height="90%" />';
                        $(image).insertAfter('.row:last');
                    }
                });
            });
            // remove the image from the modal
            $('#viewProperty').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.image').remove();
            });

            //delete
            $('#propertyTable').on('click','#propertyDelete', function (){
                var propertyDelete = $(this).data('property-delete');
                var token = $("meta[name='csrf-token']").attr("content");

                if(confirm("Are you sure, you want to remove it?")){
                    $.ajax({
                        type: "DELETE",
                        url: "properties/" + propertyDelete,
                        data: {
                            "id": propertyDelete,
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
                }
            });
        });
    </script>

@endsection