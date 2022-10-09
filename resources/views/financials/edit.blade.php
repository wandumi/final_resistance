@extends('backend.app')

@section('header')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Financials</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('financials/financial') }}">Financials</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Financials</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Financial</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('financials/financial') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="financialEdit" class="col-md-8 offset-lg-2 py-5">
                @if($message =  session('message'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif

                <form id="financialSection" action="{{ route('financial.update', $financial->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="financial_section_id">Financial Lists</label>
                                    <select name="financial_section_id" class="form-control" id="financial_section_id">
                                        <option default disabled selected>Select Financial Lists*</option>
                                        @foreach($financialLists as $lists)
                                                <option value="{{ $lists->id }}" @if($financial->financial_section->id == $lists->id) selected @endif >
                                                    {{ $lists->name}}
                                                </option>
                                        @endforeach
                                    </select>

                                    @error('financial_section_id')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                            id="name" placeholder="Enter PDF Name*" value="{{ $financial->name }}">
                                    @error('name')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror"
                                            id="slug" placeholder="Enter Slug*" value="{{ $financial->slug }}">
                                    @error('slug')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
        

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <select class="form-control" name="year" id="year">
                                        <option default disabled selected @if($financial->year == null) selected @endif>Select a Year</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->year }}" @if($financial->year == $year->year) selected @endif>{{ $year->year }}</option>
                                        @endforeach
                                        
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date_of_document"> Date </label>
                                    <input  name="date_of_document" type="date"  class="form-control @error('date_of_document') is-invalid @enderror"
                                            id="date_of_document" placeholder="Enter PDF Date of creation*" value="{{ $financial->date_of_document }}">
                                    @error('date_of_document')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div> 

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <iframe src="{{ asset('pdf_files/'.$financial->pdf) }}"  height="300" width="100%" ></iframe>
                                    <label for="pdf">Upload PDF</label>
                                    <input type="file" class="form-control @error('pdf') is-invalid @enderror" name="pdf" id="pdf">
                                    @error('pdf')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <img src="{{ $financial->cover_image ? asset('cover_images/'. $financial->cover_image) : "http://via.placeholder.com/150X150" }}"  height="300" width="100%"  />
                                    <label for="cover_image" class="mt-1">Upload Cover Image (596 X 842) </label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image">
                                    @error('cover_image')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>

                        </div>

                        <div class="col-lg-12 mt-5">

                            <button type="submit" id="form-submit" class="btn btn-primary btn-block">Submit</button>

                        </div>
                        
                </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

    


@endsection
