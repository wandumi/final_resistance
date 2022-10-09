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
            <li class="breadcrumb-item active" aria-current="page">Shareholder Analysis</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Show</h6>
                <div>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('shareholders') }}">Back <i
                            class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            
            <div class="table-responsive p-3">
              

                <div class="my-5">
                    
                    <div class="col-md-10 offset-lg-1 py-2">
                        <h3>Table</h3>
                    </div>
                    <div class="my-5">
                        {!! $shareholder->tables !!}
                    </div>
                    <hr>
                    <div class="col-md-10 offset-lg-1 py-2">
                        <h3>Description</h3>
                        <p>{!! $shareholder->description !!}</p>
                    </div>
                        
                    
                </div>
                
            </div>
            
            <div class="card-footer"></div>
        </div>
    </div>

   


@endsection

