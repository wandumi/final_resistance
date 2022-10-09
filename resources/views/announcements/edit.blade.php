
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
        <h1 class="h3 mb-0 text-gray-800">Company Announcement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('announcements') }}">Company Announcement</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit </li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('announcements') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="propertiesEdit" class="col-md-7 offset-lg-2 py-5">
                @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="announcement" action="{{ route('announcements.update', $announcement->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Enter PDF Name*" value="{{ $announcement->name }}">
                                        @error('name')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror"
                                                id="slug" placeholder="Enter Slug*" value="{{ $announcement->slug }}">
                                        @error('slug')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="date_of_document"> Date </label>
                                        <input  name="date_of_document" type="date"  class="form-control @error('date_of_document') is-invalid @enderror"
                                                id="date_of_document" placeholder="Enter PDF Date of creation*" value="{{ $announcement->date_of_document }}">
                                        @error('date_of_document')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <select class="form-control" name="year" id="year">
                                            <option default disabled selected @if($announcement->year == null) selected @endif>Select a Year</option>
                                            <option value="2022" @if($announcement->year == "2022") selected @endif>2022</option>
                                            <option value="2021" @if($announcement->year == "2021") selected @endif>2021</option>
                                            <option value="2020" @if($announcement->year == "2020") selected @endif>2020</option>
                                            <option value="2019" @if($announcement->year == "2019") selected @endif>2019</option>
                                        </select>
                                        @error('year')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="col-lg-12">
    
                                    <div class="form-group">
                                        <iframe src="{{ asset('pdf_files/'.$announcement->pdf) }}"  height="400" width="100%"  ></iframe>
                                        <label for="pdf">Upload PDF</label>
                                        <input type="file" value="{{ $announcement->pdf }}" class="form-control @error('pdf') is-invalid @enderror" name="pdf" id="pdf">
                                        @error('pdf')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="height:40px; width:100%;">
                                        
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
