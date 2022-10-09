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
        <h1 class="h3 mb-0 text-gray-800">Edit Presentations</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('presentations/presentation') }}">Presentations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Presentations</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Presentation</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('presentations/presentation') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="presentationEdit" class="col-md-8 offset-lg-2 py-5">
                @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="presentation" action="{{ route('presentation.update', $presentation->id ) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="presentation_section_id">Presentation Lists</label>
                                            <select name="presentation_section_id" class="form-control" id="presentation_section_id">
                                                <option default disabled selected>Select presentation Lists*</option>
                                                @foreach($presentationLists as $lists)
                                                        <option value="{{ $lists->id }}" @if($presentation->presentation_section->id == $lists->id) selected @endif >
                                                            {{ $lists->name}}
                                                        </option>
                                                 
                                                @endforeach
                                            </select>

                                            @error('financial_section_id')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                                    id="name" placeholder="Enter PDF Name*" value="{{ $presentation->name }}">
                                            @error('name')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror"
                                                    id="slug" placeholder="Enter Slug*" value="{{ $presentation->slug }}">
                                            @error('slug')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <select class="form-control" name="year" id="year">
                                                <option default disabled selected @if($presentation->year == null) selected @endif>Select a Year</option>
                                                @foreach ($years as $year )
                                                    <option value="{{ $year->year }}" @if($presentation->year == $year->year) selected @endif>{{ $year->year  }}</option>
                                                @endforeach
                                           
                                            </select>
                                            @error('year')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                

                                    <div class="col-md-6 mb-lg-3">
                                        <div class="form-group">
                                            <label for="date_of_document"> Date </label>
                                            <input  name="date_of_document" type="date"  class="form-control @error('date_of_document') is-invalid @enderror"
                                                    id="date_of_document" placeholder="Enter PDF Date of creation*" value="{{ $presentation->date_of_document }}">
                                            @error('date_of_document')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> 

                                  

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <iframe src="{{ asset('pdf_files/'.$presentation->upload) }}"  height="300" width="100%" ></iframe>
                                            <label for="upload">Upload PDF File</label>
                                            <input type="file" class="form-control @error('upload') is-invalid @enderror" name="upload" id="upload">
                                            <input type="hidden" name="hidden_upload" value="{{ $presentation->upload }}" />
                                            @error('upload')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div style="height:40px; width:100%;">

                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <img src="{{ $presentation->cover_image ? asset('cover_images/'. $presentation->cover_image) : "http://via.placeholder.com/150X150" }}"  height="300" width="100%"  />
                                            
                                            <label for="cover_image" class="mt-1">Upload Cover Image ( 1020 X 631) </label>
                                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image">
                                            <input type="hidden" name="hidden_cover_image" value="{{ $presentation->cover_image }}" />
                                            @error('cover_image')
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

    <!-- Modal Logout -->
    <div class="modal fade" id="viewPresentation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">View Image/PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div> 


@endsection


@section('footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#presentationTable').on('click','#showImage', function (){
                var presentationId = $(this).data('presentation');
                $.ajax({
                    type: "GET",
                    url: "presentation/" + presentationId,
                    success: function(result) {
                        console.log(result);
                        $('#viewOresentation').modal('show');
                        var image = '<img class="image" src="/logos/'+ result.logo +'" width="100%" height="90%" />';
                        $(image).insertAfter('.row:last');
                    }
                });
            });
            // remove the image from the modal
            $('#viewPresentation').on('hidden.bs.modal', function(){ //hidden.bs.modal
                $('.image').remove();
            });
            //delete
            $('#presentationTable').on('click','#presentationDelete', function (){
                var presentationDelete = $(this).data('presentation-delete');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type: "DELETE",
                    url: "presentation/" + presentationDelete,
                    data: {
                        "id": presentationDelete,
                        "_token": token,
                    },
                    success: function(result) {
                        console.log(result);
                        alert('Deleted Successfully');
                        
                        setInterval(() => {
                            location.reload();
                        }, 500);
                    }
                });
            });
        });
    </script>

@endsection


