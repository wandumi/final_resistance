
@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Year</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('years') }}">Year</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('years') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="bbbeeEdit" class="col-md-6 offset-lg-3 py-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="BBBEE" action="{{ route('years.update', $year->id ) }}" method="post" >
                            @csrf
                            @method('PATCH')
                            
                         

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input name="year" type="text"  class="form-control @error('year') is-invalid @enderror"
                                                id="year" placeholder="Enter year*" value="{{ $year->year }}">
                                        @error('year')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
    
                            <div class="col-md-12">
    
                                <button type="submit" id="form-submit" class="btn btn-primary btn-block">Update</button>
    
                            </div>
    
                        </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

@endsection

