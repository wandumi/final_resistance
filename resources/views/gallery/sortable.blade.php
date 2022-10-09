
@extends('backend.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sort Gallery Files</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('galleries') }}">Gallery</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gallery Sorting for</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sort Gallery Files</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url()->previous() }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="arrageGalleries" class="col-md-12">
                  <gallery-sort :gallerydata="{{ $galleries->toJson() }}"></gallery-sort>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

@endsection

