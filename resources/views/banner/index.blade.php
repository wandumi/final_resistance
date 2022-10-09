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
        <h1 class="h3 mb-0 text-gray-800">Page Banners</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Page Banners</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                <div>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('page_banners/create') }}">Add New <i
                            class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="table-responsive p-3">
               
                <table class="table align-items-center table-flush" id="bannerTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Page Name</th>
                        <th>Slug</th>
                        <th>Page Banner</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($banners as $banner)
                        <tr>
                            <td>{{ $banner->page_name }}</td>

                            <td>{{ $banner->slug }}</td>
                            
                            <td>
                                <img src="{{ asset('banners/'.$banner->page_bunner) }}" alt="{{ $banner->page_bunner }}" height="60" width="100vh" /> 
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('page_banners/'.$banner->id.'/edit' ) }}" data-bannerEdit="{{ $banner->id }}">Edit</a>

                                <a class="btn btn-sm btn-danger" id="bannerDelete" href="javascript:void(0);" data-banner-delete="{{ $banner->id }}">Delete</a>
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
          
        
            $('#bannerTable').DataTable({
                // "bFilter" : false,
                "aaSorting": [[ 2, "desc" ]] // Sort by first column descending
            });

            $('#bannersTable').on('click','#bannerDelete', function (){

                var bannersDelete = $(this).data('banner-delete');
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    type: "DELETE",
                    url: "page_banners/" + bannersDelete,
                    data: {
                        "id": bannersDelete,
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