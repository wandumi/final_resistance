<?php
    function hasId($arr, $id) {
        foreach ($arr as $value) {
            if ($value['logo_id'] == $id) return true;
        }
        return false;
    }
?>

@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
                integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />


        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Portfolio</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('properties') }}">Portfolio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ ucwords(strtolower($property->name)) }}</li>
        </ol>
    </div>

    <!-- Basic Information  -->
    <div class="col-xl-10 col-lg-10 offset-lg-1 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit {{ ucwords(strtolower($property->name)) }}</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('properties') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="basicEdit" class="col-md-12 col-lg-10 offset-lg-1 py-5">
                @if($message =  session('message'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif

                <form id="properties" action="{{ route('properties.update', $property->id ) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row mb-5">
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter Name of the property*" value="{{ $property->name }}">
                                @error('name')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" placeholder="Enter Slug*" value="{{ $property->slug }}">
                                @error('slug')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <img src="{{ asset('banner_images/'.$property->banner_image) }}" data-toggle="lightbox"
                                            class="img-fluid img-thumbnail img-responsive" />
                                            <div></div>
                                    <label for="banner_image">Banner Image ( 1920px X 847px ) - compress @ <a href="http://www.shortpixel.com" target="_blank">www.shortpixel.com</a> </label>

                                    <input type="file" value="{{ old('banner_image') }}" class="form-control @error('banner_image') is-invalid @enderror"
                                            name="banner_image" id="banner_image">
                                    @error('banner_image')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <img src="{{ asset('cover_images/'.$property->cover_image) }}" class="img-fluid img-thumbnail" />
                                    <div></div>
                                    <label for="cover_image">Cover Image ( 1020px X 646px ) - compress @ <a href="http://www.shortpixel.com" target="_blank">www.shortpixel.com</a> </label>
                                    <input type="file" value="{{ old('cover_image') }}" class="form-control @error('cover_image') is-invalid @enderror"
                                            name="cover_image" id="cover_image">
                                    @error('cover_image')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pronvice_id">Pronvices</label>
                                <select name="pronvice_id" class="form-control" id="pronvice_id">
                                    <option default disabled selected>Select pronvices</option>
                                    @foreach($pronvices as $lists)
                                        <option value="{{ $lists->id }}" @if($property->pronvice->id == $lists->id) selected @endif >
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
                                <label for="featured" class="mt-2">Featured</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="featured"
                                    name="featured" @if($property->featured) checked @endif
                                    >
                                    <label class="custom-control-label" for="featured"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="websit_link">Website Link</label>
                                <input name="website_link" type="text"  class="form-control @error('website_link') is-invalid @enderror"
                                        id="website_link" placeholder="Enter website_link*" value="{{ $property->website_link }}">
                                @error('website_link')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                
                                <textarea name="description" id="description" rows="10" class="form-control">{{ str_pad($property->description, 0) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row my-4">
                        <div class="col-md-12">
                            <h4>Banner Details</h4>
                        </div>
                    </div>


                    <div class="row">

                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vacancy">Vacancy</label>
                                <input name="vacancy" type="text"  class="form-control"
                                        id="vacancy" placeholder="Enter Vacancies" value="{{ $property->vacancy }}" @error('vacancy') is-invalid @enderror>
                                @error('vacancy')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gla">GLA</label>
                                <input name="gla" type="text"  class="form-control"
                                        id="gla" placeholder="Enter the GLA" value="{{ $property->gla }}" @error('gla') is-invalid @enderror>
                                @error('gla')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                       


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pro_rata_interest">Pro Rata Interest</label>
                                    <input type="text" class="form-control" name="pro_rata_interest" id="pro_rata_interest"
                                       value="{{ $property->pro_rata_interest }}" placeholder="Enter Pro Rata Interest" />
                                    @error('pro_rata_interest')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="primary_use">Primary Use</label>
                                <input name="primary_use" type="text"  class="form-control"
                                        id="primary_use" placeholder="Enter Primary Use" value="{{ $property->property_use }}" @error('primary_use') is-invalid @enderror>
                                @error('primary_use')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                       

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="parking">Parking</label>
                                <input name="parking" type="text"  class="form-control"
                                        id="parking" placeholder="Enter the parking capacity" value="{{ $property->parking }}" @error('parking') is-invalid @enderror>
                                @error('parking')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="evaluation">Valuation</label>
                                <input name="evaluation" type=""  class="form-control"
                                        id="evaluation" placeholder="Enter valuation" value="{{ $property->valuation }}" @error('evaluation') is-invalid @enderror>
                                    @error('evaluation')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date of Accusion</label>
                                <input name="date" type="date"  class="form-control"
                                        id="date" value="{{ $property->date_of_accusion }}" @error('date') is-invalid @enderror>
                                    @error('date')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address"
                                          placeholder="Enter the address">{{ $property->address }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                            </div>
                        </div>



                    </div> --}}

                    

                    <div class="row my-4">
                        <div class="col-md-12 d-flex justify-content-between">
                            <h4>Property Gallery</h4>
                            <a href="{{ url('gallery_sortable', $property->id) }}" class="btn btn-sm btn-primary">Sort Images</a>
                        </div>
                    </div>

                    <div class="row">

                        @foreach ($galleries as $gallery )


                                    <div class="col-md-3 mb-4">
                                        <a href="{{ asset('gallery/'.$gallery->image) }}" data-toggle="lightbox" data-gallery="img-gallery" class="col-sm-4">
                                            <img src="{{ asset('gallery/'.$gallery->image) }}" alt="{{ $gallery->name }}" class="img-fluid img-thumbnail"  />

                                        </a>
                                        <div style="text-align: center">{{ $gallery->name }}</div>
                                    </div>



                        @endforeach


                    </div>

                    <div class="row px-3 mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="garalley_name" type="text"  class="form-control"
                                        id="garalley_name" placeholder="Enter Name of the Gallery*" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" value="" class="form-control "
                                        name="image" id="image">
                                    <span class="text-danger" id="image-input-error"></span>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                    <div class="col-lg-12">

                        <button type="submit" id="form-submit" class="btn btn-primary btn-block">Update</button>

                    </div>

                </form>

            </div>

            <div class="card-footer"></div>
        </div>
    </div>

    <!-- Add Logos -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tenant Logos</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('properties') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="uploadLogos" class="col-md-12">

                <div class="row mb-5">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="font-weight-light text-primary">Anchor Tenants</h6>
                            </div>
                    
                            <form action="" id="anchor">
                                <div class="col-md-12 px-3 py-3">
                                    <div class="row">

                                        @foreach ($logos as $logo )
                                            <div class="col-md-3">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                    <input class="form-check-anchor" type="checkbox" id="{{ $logo->id }}" name="anchor[]"
                                                                            value="{{ $logo->id }}" @if(hasid($anchors,$logo->id)) checked @endif />
                                                                    <label class="form-check-label"  for="{{ $logo->name}}">{{ $logo->name }}</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                            </div>

                                        @endforeach
                                
                                        <input type="hidden" id="property_id" name="property_id" value="{{ $property->id }}" />

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="font-weight-light text-primary">Major Tenants</h6>
                            </div>
                            <form action="" id="major">

                                <div class="col-md-12 px-3 py-3">
                                    <div class="row">

                                        @foreach ($logos as $logo )
                                            <div class="col-md-3">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-major" id="{{ $logo->id }}" 
                                                                   name="major[]" value="{{ $logo->id }}" @if(hasid($majors,$logo->id)) checked @endif>
                                                            <label class="form-check-label" for="{{ $logo->id }}">{{ $logo->name }}</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>


                                        @endforeach
                                    </div>

                                    <input type="hidden" id="property_id" name="property_id" value="{{ $property->id }}" />

                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="font-weight-light text-primary">Follow the Fun</h6>
                            </div>
                    
                            <form action="" id="following">

                                <div class="col-md-12 px-4 py-3">

                                    <div class="row">
                                
                                        @foreach ($logos as $logo )
                                            <div class="col-md-3">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-fun" id="{{ $logo->id }}" name="Fun[]" 
                                                                   value="{{ $logo->id }}" @if(hasid($followings,$logo->id)) checked @endif />
                                                            <label class="form-check-label" for="{{ $logo->id }}">{{ $logo->name }}</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>


                                        @endforeach
                                    
                                    </div>

                                    <input type="hidden" id="property_id" name="property_id" value="{{ $property->id }}" />

                                </div>
                            </form>
                        </div>
                    </div>

                </div>







            </div>

            <div class="card-footer"></div>
        </div>
    </div>


@endsection

@section('footer')

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // the anchor tenants logo
            $('.form-check-anchor').on('change', function(event){ 
                event.preventDefault();
                console.log(event)
                let propertyID = document.getElementById('property_id').value;

                var formData = $('#anchor').serialize();
                console.log('Posting the following: ', formData);

                $.ajax({
                url: '/anchor/'+ propertyID,
                data: formData,
                type: 'PATCH',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                }
                });
            });

            // the major tenants logo
            $('.form-check-major').on('change', function(event){ 
                event.preventDefault();

                let propertyID = document.getElementById('property_id').value;


                var formData = $('#major').serialize();
                console.log('Posting the following: ', formData);

                $.ajax({
                    url: '/major/'+ propertyID,
                    data: formData,
                    type: 'PATCH',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                    }
                });
            });

            //the thefun tenants logo
            $('.form-check-fun').on('change', function(event){ 
                event.preventDefault();

                let funID = document.getElementById('property_id').value;

                var formData = $('#following').serialize();
                console.log('Posting the following: ', formData);

                $.ajax({
                    url: '/following/'+ funID,
                    data: formData,
                    type: 'PATCH',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });


        });
    </script>
    
@endsection







