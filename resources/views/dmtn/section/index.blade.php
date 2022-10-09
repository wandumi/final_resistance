@extends('layouts.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">    
        
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">All Dmtn Sections</h5>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('dmtns/dmtn_sections/create') }}">Add New <i
                            class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive" id="dmtnListTable">
                    @if($dmtnLists)
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($dmtnLists as $dmtnList)
                            <tr>
                                <td>{{ $dmtnList->name }}</td>
                                
                                <td>
                              
                                    <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('dmtns/dmtn_sections/'.$dmtnList->id.'/edit' ) }}" data-dmtnListEdit="{{ $dmtnList->id }}">Edit</a>

                                    <a class="btn btn-sm btn-danger" id="dmtnListDelete" href="javascript:void(0);" data-dmtnList-delete="{{ $dmtnList->id }}">Delete</a>

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
       
    </div>
</div>

   <!-- Modal Logout -->
   <div class="modal fade" id="viewdmtnList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">View dmtnList PDF</h5>
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

    <script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
         <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

        $(document).ready(function(){
          
            $('#dmtnListTable').DataTable();
            $('#dmtnListTable').on('click','#showImage', function (){

                var dmtnListId = $(this).data('dmtnList');


                $.ajax({
                    type: "GET",
                    url: "dmtnList/" + dmtnListId,
                    success: function(result) {
                        console.log(result);

                        $('#viewdmtnList').modal('show');

                        //var pdf = '<img class="pdf" src="/pdf_files/'+ result.pdf +'" width="100%" />';
                        var pdf = '<iframe class="pdf" src="/pdf_files/' + result.pdf +'" height="100%" width="100%" ></iframe>';

                        $(pdf).insertAfter('.row:last');


                    }
                });
            });

            // remove the image from the modal
            $('#viewdmtnList').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.pdf').remove();
            });

            $('#dmtnListTable').on('click','#dmtnListDelete', function (){

                var dmtnListDelete = $(this).data('dmtnList-delete');
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    type: "DELETE",
                    url: "dmtnList/" + dmtnListDelete,
                    data: {
                        "id": dmtnListDelete,
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