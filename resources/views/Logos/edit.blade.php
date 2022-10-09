
@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />


@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tenant Logo</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('logos') }}">Tenant Logo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('shop_logos') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="LogoEdit" class="col-md-8 offset-lg-2 py-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="logo" action="{{ route('shop_logos.update', $logo->id ) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Enter Logo Name*" value="{{ $logo->name }}">
                                        @error('name')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror"
                                                id="slug" placeholder="Enter Slug*" value="{{ $logo->slug }}">
                                        @error('slug')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="col-md-12">
    
                                    <div class="form-group">
                                    
                                        <label for="image">Upload a Logo</label>
                                        <input type="file" value="{{ $logo->image }}" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                                        @error('image')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="height:40px; width:100%;">
                                        
                                    </div>
                                </div>

                                <div class="col-md-12 mb-5">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('logos/'.$logo->image) }}" alt="{{ asset('logos/'.$logo->image) }}" class="img-thumbnail">
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

