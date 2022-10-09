
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
        <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url(' calendar') }}">Calendar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('calendar') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="calendarEdit" class="col-md-6 offset-lg-3 py-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="calendar" action="{{ route('calendar.update',  $calendar->id ) }}" method="post">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                                id="name" value="{{  $calendar->name }}">
                                        @error('name')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start"> Start Date </label>
                                        <input  name="start" type="date"  class="form-control @error('start') is-invalid @enderror"
                                                id="start" value="{{  $calendar->start }}">
                                        @error('start')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end"> End Date </label>
                                        {{-- datetime-local --}}
                                        <input  name="end" type="date"  class="form-control @error('end') is-invalid @enderror"
                                                id="end" placeholder="Enter PDF Date of creation*" value="{{  $calendar->end }}">
                                        @error('end')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
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

