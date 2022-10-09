@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrercreditRating="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
          

@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DMTM Programme</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> DMTN Programme</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Credit Rating</h6>

                <div>
                    <a class="m-0 float-left mr-2 btn btn-info btn-sm" href="{{ url('dmtns/credit_ratings_sortable') }}">Sort Credit Ratings</a>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('dmtns/credit_ratings/create') }}">Add New <i
                            class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="table-responsive p-3" >
                
                        <table class="table align-items-center table-flush" id="creditRatingTable">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                           
                                <th>Date</th>
                                <th>PDF</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($creditRatings as $creditRating)
                                <tr>
                                    <td>
                                        {{ $creditRating->name }}
                                    </td>
                                   
                                    <td>{{ $creditRating->date_of_document }}</td>
                                    <td>
                                        <iframe src="{{ asset('pdf_files/'.$creditRating->pdf) }}"  height="60" width="100vh" ></iframe>
                                    </td>
                                   
                                    <td>

                                        <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('dmtns/credit_ratings/'.$creditRating->id.'/edit' ) }}" >Edit</a>

                                        <a class="btn btn-sm btn-danger" id="creditRatingDelete" href="javascript:void(0);" data-credit_rating-delete="{{ $creditRating->id }}">Delete</a>


                                        {{-- <input data-id="{{ $creditRating->id }}" class="toggle-class btn btn-md" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Approve" data-off="Ignore"
                                                {{ $creditRating->status ? 'checked' : '' }}
                                            /> --}}


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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function(){

           $('#creditRatingTable').DataTable({
                // "bFilter" : false,
                "aaSorting": [[ 2, "desc" ]] // Sort by first column descending
           });
            //delete
            $('#creditRatingTable').on('click','#creditRatingDelete', function (){


                var creditRatingDelete = $(this).data('credit_rating-delete');
            
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    type: "DELETE",
                    url: "credit_rating/" + creditRatingDelete,
                    data: {
                        "id": creditRatingDelete,
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