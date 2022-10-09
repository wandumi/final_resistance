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
        <h1 class="h3 mb-0 text-gray-800">Financials</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">financial categories</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('financials/financial_section/create') }}">Add New <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive p-3" >
                @if($financialLists)
                <table class="table align-items-center table-flush" id="financialSectionTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($financialLists as $financial)
                        <tr>
                            <td>
                                {{ $financial->name}}
                            </td>
                            <td>
                                {{ $financial->slug }}
                            </td>
                            
                            <td>

                                <a class="btn btn-sm btn-info" id="showEdit" href="{{ url('financials/financial_section/'.$financial->id.'/edit') }}" data-financialEdit="{{ $financial->id }}">Edit</a>

                                <a class="btn btn-sm btn-danger" id="financialDelete" href="javascript:void(0);" data-financial-delete="{{ $financial->id }}">Delete</a>

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


@endsection


@section('footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#financialSectionTable').DataTable();

            // remove the image from the modal
            $('#viewFinancialSection').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.cover_image').remove();
            });

            //delete 
            $('#financialSectionTable').on('click','#financialDelete', function (){

                var financialDelete = $(this).data('financial-delete');
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    type: "DELETE",
                    url: "financial_section/" + financialDelete,
                    data: {
                        "id": financialDelete,
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

