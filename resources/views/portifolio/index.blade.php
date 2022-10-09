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
        <h1 class="h3 mb-0 text-gray-800">Portfolios</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Portfolios</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('portifolios/portifolio/create') }}">Add New <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive p-3" >
                @if($portifolios)
                <table class="table align-items-center table-flush" id="portfolioTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Property</th>
                        <th># of shares</th>
                        <th>% Issued of Shares</th>
                        <th>Cover Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($portifolios as $portifolio)
                        
                        <tr>
                            <td>
                              Property Name
                            </td>
                            <td>{{ $portifolio->numberOfShared }}</td>
                            <td>{{ $portifolio->perOfIssueShares }}</td>

                            <td>
                                <img src="{{ $portifolio->cover_image ? asset('cover_images/'. $portifolio->cover_image) : "http://via.placeholder.com/150X150" }}"
                                    style="width: 100px; height: 80px;" />
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" id="showImage" href="javascript:void(0);" data-portifolio="{{ $portifolio->id }}">View</a>

                                <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('portifolios/portifolio/'.$portifolio->id.'/edit ') }}" data-portifolioEdit="{{ $portifolio->id }}">Edit</a>

                                <a class="btn btn-sm btn-danger" id="portifolioDelete" href="javascript:void(0);" data-portifolio-delete="{{ $portifolio->id }}">Delete</a>

                            </td>
                        </tr>

                    @endforeach
                    @else
                        <p class="d-flex align-center justify-content-center">There is no data</p>
                    @endif


                    </tbody>
                    <tfoot class="thead-light">
                        
                    </tfoot>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

   
    <!-- Modal Logout -->
    <div class="modal fade" id="viewPortifolio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
          
            $('#portfolioTable').DataTable();

            $('#portifolioTable').on('click','#showImage', function (){

                var portifolioId = $(this).data('portifolio');

                

                $.ajax({
                    type: "GET",
                    url: "portifolio/" + portifolioId,
                    success: function(result) {
                        console.log(result);

                        $('#viewPortifolio').modal('show');

                        var image = '<img class="cover_image" src="/cover_images/'+ result.cover_image +'" width="100%" height="90%" />';

                        $(image).insertAfter('.row:last');


                    }
                });
            });

            // remove the image from the modal
            $('#viewPortifolio').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.cover_image').remove();
            });

            //delete 
            $('#portfolioTable').on('click','#portifolioDelete', function (){

                var portifolioDelete = $(this).data('portifolio-delete');
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    type: "DELETE",
                    url: "portifolio/" + portifolioDelete,
                    data: {
                        "id": portifolioDelete,
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