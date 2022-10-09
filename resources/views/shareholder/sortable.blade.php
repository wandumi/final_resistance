
@extends('backend.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sort Shareholders</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('shareholders') }}">Shareholders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shareholders Sortable</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sort All</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('shareholders') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="arrageShareholders" class="col-md-12">
                  <shareholder-sort :shareholderdata="{{ $shareholders->toJson() }}"></shareholder-sort>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

@endsection