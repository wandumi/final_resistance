@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <style>
        .alert-success {
            background-color: #66bb6a !important;
        }
    </style>
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Portifolio Banner</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('portifolio_banners') }}">Portifolio Banner</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('portifolio_banners') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="portifolioBannerTable" class="col-md-6 offset-lg-3 py-5 ">
                @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="portifolioBanners" action="{{ route('portifolio_banners.update', $portifolioBanner->id) }}" method="post" >
                            @csrf
                            @method('PATCH')

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="total_GLA">Total GLA</label>
                                    <input name="total_GLA" type="text"  class="form-control @error('total_GLA') is-invalid @enderror"
                                            id="" placeholder="Enter Total GLA*" value="{{ $portifolioBanner->total_GLA }}">
                                    @error('total_GLA')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="total_vacancy">Total Vacancy</label>
                                    <input name="total_vacancy" type="text"  class="form-control @error('total_vacancy') is-invalid @enderror"
                                            id="" placeholder="Enter Total Vacancy*" value="{{ $portifolioBanner->total_vacancy }}">
                                    @error('total_vacancy')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="total_valuation">Total Valuation</label>
                                    <input name="total_valuation" type="text"  class="form-control @error('total_valuation') is-invalid @enderror"
                                            id="" placeholder="Enter Total Valuation*" value="{{ $portifolioBanner->total_valuation }}">
                                    @error('total_valuation')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="total_weighted">Total Weighted Average Rate Per m2</label>
                                    <textarea class="form-control @error('total_weighted') is-invalid @enderror" name="total_weighted" 
                                        placeholder="Enter Total Weighted Average"
                                        id="total_weighted" rows="5">{{ $portifolioBanner->total_weighted }}</textarea>
                                    @error('total_weighted')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            
    
                            <div class="col-lg-12">
    
                                <button type="submit" id="form-submit" class="btn btn-primary btn-block">Submit</button>
    
                            </div>
    
                        </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>




@endsection

@section('footer')
    <script type="text/javascript">
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        CKEDITOR.replace( 'total_weighted', {} );
        CKEDITOR.config.coreStyles_superscript = { element: 'sup' };
    </script>
@endsection

