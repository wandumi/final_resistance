@extends('layouts.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .modal-dialog,
        .modal-content {
            /* 80% of window height */
            height: 90%;
        }
    </style>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All dmtns</h5>
                        <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('dmtns/dmtn/create') }}">Add New <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="table-responsive" id="dmtnTable">
                        @if($dmtns)
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>dmtn Section</th>
                                <th>Name</th>
                                <th>PDF</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($dmtns as $dmtn)
                                <tr>
                                    <td>
                                        @foreach($dmtnLists as $list)
                                       
                                            @if($list->id === $dmtn->dmtn_section_id)
                                                {{ $list->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <iframe src="{{ asset('pdf_files/'.$dmtn->pdf) }}"  height="150" width="200vh" ></iframe>
                                    </td>
                                   
                                    <td>

                                        <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('dmtns/dmtn/'.$dmtn->id.'/edit' ) }}" data-finacialEdit="{{ $dmtn->id }}">Edit</a>

                                        <a class="btn btn-sm btn-danger" id="dmtnDelete" href="javascript:void(0);" data-dmtn-delete="{{ $dmtn->id }}">Delete</a>

                                        <input data-id="{{ $dmtn->id }}" class="toggle-class btn btn-md" type="checkbox" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Approve" data-off="Ignore"
                                                {{ $dmtn->status ? 'checked' : '' }}
                                            />


                                    </td>
                                </tr>

                            @endforeach
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


@endsection

@section('footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#dmtnTable').on('click','#showImage', function (){
                var dmtnId = $(this).data('dmtn');
                $.ajax({
                    type: "GET",
                    url: "dmtn/" + dmtnId,
                    success: function(result) {
                        console.log(result);
                        $('#viewdmtn').modal('show');
                        var image = '<img class="image" src="/logos/'+ result.logo +'" width="100%" height="90%" />';
                        $(image).insertAfter('.row:last');
                    }
                });
            });
            // remove the image from the modal
            $('#viewdmtn').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.image').remove();
            });
            //delete
            $('#dmtnTable').on('click','#dmtnDelete', function (){
                var dmtnDelete = $(this).data('dmtn-delete');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type: "DELETE",
                    url: "dmtn/" + dmtnDelete,
                    data: {
                        "id": dmtnDelete,
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