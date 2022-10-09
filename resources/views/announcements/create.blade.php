@extends('backend.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Company Announcement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('announcements') }}">Company Announcement</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Create</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('announcements') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="propertiesTable" class="col-md-6 offset-lg-3 py-5 ">
                @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="BBBEE" action="{{ route('announcements.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                            id="name" placeholder="Enter PDF Name*" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date_of_document"> Date </label>
                                    <input  name="date_of_document" type="date"  class="form-control @error('date_of_document') is-invalid @enderror"
                                            id="date_of_document" placeholder="Enter PDF Date of creation*" value="{{ old('date_of_document') }}">
                                    @error('date_of_document')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <select class="form-control @error('year') is-invalid @enderror" name="year" id="year">
                                        <option default disabled selected>Select Year</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="pdf">Upload PDF</label>
                                    <input type="file" value="{{ old('pdf') }}" class="form-control @error('pdf') is-invalid @enderror" name="pdf" id="pdf">
                                    @error('pdf')
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
