@extends('backend.app')

@section('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

@endsection


@section('content')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Schedule of Property</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('schedules_properties') }}">Schedule of Property</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </div>

        <!-- creating  -->
        <div class="col-xl-12 col-lg-12 col-md-12 pl-0">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create</h6>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('schedules_properties') }}">Back <i
                            class="fas fa-chevron-right"></i></a>
                </div>
                <div id="schedulesPropertiesTable" class="col-md-8 offset-lg-2  py-5 ">
                    @if($message =  session('message'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif

                    <form id="schedules_properties" action="{{ route('schedules_properties.store') }}" method="post">
                        @csrf

                        <div class="row">

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


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_accusion">Date of Accusion</label>
                                    <input name="date_of_accusion" type="datetime-local"  class="form-control  @error('date_of_accusion') is-invalid @enderror"
                                            id="date_of_accusion" value="{{ old('date_of_accusion') }}" min="" max="" />
                                        @error('date_of_accusion')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="property_use">Property Use</label>
                                    <input name="property_use" type="text"  class="form-control @error('property_use') is-invalid @enderror"
                                            id="property_use" placeholder="Enter Property Use" value="{{ old('property_use') }}" >
                                    @error('property_use')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vacancy">Vacancy</label>
                                    <input name="vacancy" type="text"  class="form-control @error('vacancy') is-invalid @enderror"
                                            id="vacancy" placeholder="Enter Vacancies" value="{{ old('vacancy') }}" >
                                    @error('vacancy')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gla">GLA</label>
                                    <input name="gla" type="text"  class="form-control @error('gla') is-invalid @enderror"
                                            id="gla" placeholder="Enter the GLA" value="{{ old('gla') }}" >
                                    @error('gla')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                    
                                </div>
                            </div>
                
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="parking">Parking</label>
                                    <input name="parking" type="text"  class="form-control @error('parking') is-invalid @enderror"
                                            id="parking" placeholder="Enter the parking capacity" value="{{ old('parking') }}" >
                                    @error('parking')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                    
                                </div>
                            </div>
                
                            
                        </div>

                        <div class="row">
                
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pro_rata_interest">Pro Rata Interest</label>
                                        <input type="text" class="form-control @error('pro_rata_interest') is-invalid @enderror" name="pro_rata_interest" id="pro_rata_interest" placeholder="Enter the Pro Rata Interest" value="{{ old('pro_rata_interest') }}"/>
                                        
                                        @error('pro_rata_interest')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valuation">Valuation</label>
                                    <input name="valuation" type=""  class="form-control @error('valuation') is-invalid @enderror"
                                            id="valuation" placeholder="Enter Valuation" value="{{ old('valuation') }}"  >
                                        @error('valuation')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control @error('country') is-invalid @enderror" name="country" id="country">
                                        <option default disabled selected>Select a role</option>
                                        <option value="south_africa">South Africa</option>
                                        <option value="france">France</option>
                                        <option value="nigeria">Nigeria</option>
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    
                                        <textarea class="form-control @error('address') is-invalid @enderror" rows="5" name="address" id="address" placeholder="Enter the address" >{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                </div>
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


