
@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">B-BBEE</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('bbbees') }}">B-BBEE</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('bbbees') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="bbbeeEdit" class="col-md-8 offset-lg-2 py-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="BBBEE" action="{{ route('bbbees.update', $bbbee->id ) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Enter PDF Name*" value="{{ $bbbee->name }}">
                                        @error('name')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror"
                                                id="slug" placeholder="Enter Slug*" value="{{ $bbbee->slug }}">
                                        @error('slug')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="col-lg-12">
    
                                    <div class="form-group">
                                        <iframe src="{{ asset('pdf_files/'.$bbbee->pdf) }}"  height="400" width="100%"  ></iframe>
                                        <label for="pdf">Upload PDF</label>
                                        <input type="file" value="{{ $bbbee->pdf }}" class="form-control @error('pdf') is-invalid @enderror" name="pdf" id="pdf">
                                        @error('pdf')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="height:40px; width:100%;">
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-lg-12">
    
                                <button type="submit" id="form-submit" class="btn btn-primary btn-block">Update</button>
    
                            </div>
    
                        </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

@endsection

