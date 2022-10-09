@extends('backend.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sort Circular Files</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('circulars') }}">Circular</a></li>
            <li class="breadcrumb-item active" aria-current="page">Circular Sortable</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sort Circular Files</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('circulars') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="arrageCirculars" class="col-md-12">
                  <circular-sort :circulardata="{{ $circulars->toJson() }}"></circular-sort>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

@endsection