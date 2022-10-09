@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <style>
        .alert-success {

            background-color: #66bb6a !important;
        
        }
    </style>
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Shareholder</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('Shareholders') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shareholder Edit</li>
        </ol>
    </div>

    <div class="col-xl-12 col-lg-12 mb-4 pl-0 mt-5">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('shareholders') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="editTables" class="col-md-10 offset-lg-1 py-5 ">
                @if($message =  session('message'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif
                
                <form action="{{ route('shareholders.update', $shareholder->id ) }}" method="post" class="mt-5">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name"> Name </label>
                            <input  name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                    id="name"   value="{{ $shareholder->name }}" />
                            @error('name')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="description form-control" >{{ $shareholder->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tables">Table</label>
                            <textarea name="tables" id="tables" class="try form-control" cols="30" rows="10">{{ $shareholder->tables }}</textarea>
                            @error('tables')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
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

@section('footer')


<script type="text/javascript">
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    CKEDITOR.replace( 'tables', {} );
    CKEDITOR.replace( 'description', {} );
</script>
    
@endsection

