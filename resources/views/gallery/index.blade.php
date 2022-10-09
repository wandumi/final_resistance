@extends('backend.app')

@section('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">


@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Property Gallaries</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">View All</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                
            </div>
            <div class="table-responsive p-3" >
         
                <table class="table align-items-center table-flush" id="galleryTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Property</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($gallaries as $gallery)
                        <tr>
                            <td>
                               
                                    @foreach($properties as $property)
                                   
                                        @if($property->id === $gallery->properties_id)
                                            {{ $property->name }}
                                        @endif
                                    @endforeach
                               
                            </td>
                            <td>
                                {{ $gallery->name }}
                            </td>

                            <td>
                                {{ $gallery->slug }}
                            </td>

                            <td>
                                <img src="{{ asset('gallery/'.$gallery->image) }}" alt=">{{ $gallery->image }}" height="60" width="100vh" /> 
                            </td>
                            
                            <td>

                                <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('galleries/'.$gallery->id.'/edit') }}" data-galleryEdit="{{ $gallery->id }}">Edit</a>

                                <a class="btn btn-sm btn-danger" id="galleryDelete" href="javascript:void(0);" data-gallery-delete="{{ $gallery->id }}">Delete</a>

                            
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
            $('#galleryTable').DataTable();

            $('#galleryTable').on('click','#showImage', function (){
                var galleryId = $(this).data('gallery');
                $.ajax({
                    type: "GET",
                    url: "gallaries/" + galleryId,
                    success: function(result) {
                        console.log(result);
                        $('#viewgallery').modal('show');
                        var image = '<img class="image" src="/logos/'+ result.logo +'" width="100%" height="90%" />';
                        $(image).insertAfter('.row:last');
                    }
                });
            });
            // remove the image from the modal
            $('#viewgallery').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.image').remove();
            });

            //delete
            $('#galleryTable').on('click','#galleryDelete', function (){
                var galleryDelete = $(this).data('gallery-delete');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type: "DELETE",
                    url: "galleries/" + galleryDelete,
                    data: {
                        "id": galleryDelete,
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