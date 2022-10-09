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
        <h1 class="h3 mb-0 text-gray-800">Shareholder Analysis</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">shareholders analysis</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                <div>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('shareholders/create') }}">Add New <i
                            class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="table-responsive p-3">
             
                <table class="table align-items-center table-flush" id="shareholderTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th width="50%">Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($shareholders as $shareholder)
                        <tr>
                            <td>{{ $shareholder->name }}</td>
                            <td>{!! substr($shareholder->description,0,250) !!}</td>
                            
                            <td>
                               
                                <a class="btn btn-sm btn-warning" href="{{ url( 'shareholders/'. $shareholder->id)}}">View</a>

                                <a class="btn btn-sm btn-primary" id="showEdit" href="{{ url('shareholders/'.$shareholder->id.'/edit' ) }}">Edit</a>

                                <a class="btn btn-sm btn-danger" id="shareholdersDelete" href="javascript:void(0);" data-shareholder-delete="{{ $shareholder->id }}">Delete</a>

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

            $('#shareholderTable').DataTable();
          
            $('#shareholderTable').on('click','#shareholdersDelete', function (){

                var shareholdersDelete = $(this).data('shareholder-delete');
                
                var token = $("meta[name='csrf-token']").attr("content");

                if(confirm("Are you sure, you want to remove it?")){
                    $.ajax({
                        type: "DELETE",
                        url: "shareholders/" + shareholdersDelete,
                        data: {
                            "id": shareholdersDelete,
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