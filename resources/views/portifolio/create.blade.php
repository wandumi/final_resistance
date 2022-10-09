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
        <h1 class="h3 mb-0 text-gray-800">Portfolio</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('portifolios/portifolio') }}">Portfolio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Create</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('portifolios/portifolio') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="presentationTable" class="col-md-6 offset-lg-3 py-5 ">
                @if($message =  session('message'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif
                <form id="portifolio" action="{{ url('portifolios/portifolio') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="lists">Portfolio Lists</label>
                            <select name="lists" class="form-control" id="portifolio_lists">
                                <option default selected>Select Portfolio Lists</option>
                                @foreach($portifolioLists as $lists)
                                    <option value="{{ $lists->id }}">
                                        {{ $lists->name}}
                                    </option>
                                @endforeach
                            </select>
                                        
                            @error('lists')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="numberOfShares">Number of Shares</label>
                            <input name="numberOfShares" type="number"  class="form-control @error('numberOfShares') is-invalid @enderror"
                                    id="numberOfShares" placeholder="Enter number of shares*" value="{{ old('numberOfShares') }}">
                            @error('numberOfShares')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">% Issue Shared</label>
                            <input name="perIssueShared" type="number"  class="form-control @error('perIssueShared') is-invalid @enderror"
                                    id="perIssueShared" placeholder="Enter % issues shared*" value="{{ old('perIssueShared') }}">
                            @error('perIssueShared')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="cover_image">Upload Cover Image</label>
                            <input type="file" value="{{ old('cover_image') }}" class="form-control @error('cover_image') is-invalid @enderror" 
                                    name="cover_image" id="cover_image">
                            @error('cover_image')
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

