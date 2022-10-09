
@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Propery Gallery</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('galleries') }}">Propery Gallery</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('galleries') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="galleryEdit" class="col-md-6 offset-lg-3 py-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="gallery" action="{{ route('galleries.update', $gallery->id ) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Enter PDF Name*" value="{{ $gallery->name }}">
                                        @error('name')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror"
                                                id="slug" placeholder="Enter Slug*" value="{{ $gallery->slug }}">
                                        @error('slug')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="col-md-12">
    
                                    <div class="form-group">
                                        <div class="">
                                            <img src="{{ asset('gallery/'.$gallery->image) }}" alt=">{{ $gallery->image }}" width="100%" class="img-thumbnail"/> 

                                        </div>
                                        <label for="image">Upload Image</label>
                                        <input type="file" value="{{ $gallery->image }}" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                                        @error('image')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="height:40px; width:100%;">
                                        
                                    </div>
                                </div>

                                <input type="hidden" name="property_id" value="{{ $gallery->properties_id  }}">
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

