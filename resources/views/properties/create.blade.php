@extends('backend.app')

@section('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

@endsection


@section('content')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Portfolio</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('properties') }}">Portfolio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </div>

        <!-- creating  -->
        <div class="col-xl-10 col-lg-12 col-md-12  offset-lg-1">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create</h6>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('properties') }}">Back <i
                            class="fas fa-chevron-right"></i></a>
                </div>
                <div id="propertiesTable" class="col-md-10 offset-lg-1  py-5 ">
                    @if($message =  session('message'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif

                    <form id="properties" action="{{ route('properties.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row col-md-12 mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pronvice_id">Pronvices</label>
                                    <select name="pronvice_id" class="form-control @error('pronvice_id') is-invalid @enderror" id="pronvice_id">
                                        <option default disabled selected>Select pronvices</option>
                                        @foreach($pronvices as $lists)
                                            <option value="{{ $lists->id }}">
                                                {{ $lists->name}}
                                            </option>
                                        @endforeach
                                    </select>
    
                                    @error('pronvice_id')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                            id="name" placeholder="Enter Name of the property*" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row col-md-12 mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="websit_link">Website Link</label>
                                    <input name="website_link" type="text"  class="form-control @error('website_link') is-invalid @enderror"
                                            id="website_link" placeholder="Enter website_link*" value="{{ old('website_link') }}">
                                    @error('website_link')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="mt-lg-2">Featured</div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="featured" name="featured">
                                        <label class="custom-control-label" for="featured"></label>
                                    </div>
                                </div>
                            </div>
    
                            

                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="banner_image">Banner Image (1920px X 847px) - compress @ <a href="https://www.shortpixel.com" target="_blank">www.shortpixel.com</a></label>
                                <input type="file" value="{{ old('banner_image') }}" class="form-control @error('banner_image') is-invalid @enderror"
                                    name="banner_image" id="banner_image">
                                @error('banner_image')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 mb-5">
                            <div class="form-group">
                                <label for="cover_image">Cover Image ( 1020px X 646px ) - compress @ <a href="https://www.shortpixel.com" target="_blank">www.shortpixel.com</a></label>
                                <input type="file" value="{{ old('cover_image') }}" class="form-control @error('cover_image') is-invalid @enderror"
                                        name="cover_image" id="cover_image">
                                @error('cover_image')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="10" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
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


