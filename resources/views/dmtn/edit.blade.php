@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="height: 100%;">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Edit Dmtn</h5>
                    <a href="{{ url('dmtns/dmtn') }}" class="btn btn-sm btn-primary">Back</a>
                </div>
                    <div class="col-lg-12   my-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="dmtnSection" action="" method="post" enctype="multipart/form-data">
                            @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="dmtn_section_id">dmtn Lists</label>
                                                <select name="dmtn_section_id" class="form-control" id="dmtn_section_id">
                                                    <option default disabled selected>Select dmtn Lists</option>
                                                    @foreach($dmtnLists as $lists)
                                                        <option value="{{ $lists->id }}">
                                                            {{ $lists->name}}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('dmtn_section_id')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                                        id="name" placeholder="Enter PDF Name*" value="{{ $dmtn->name }}">
                                                @error('name')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">

                                        <div class="col">
                                            <div class="form-group">
                                                {{-- <img src="{{ asset('pdf_files/'.$dmtn->upload) }}"  height="300" width="100%"  /> --}}
                                                <iframe src="{{ asset('pdf_files/'.$dmtn->pdf) }}"  height="300" width="100%" ></iframe>
                                                <label for="upload">Upload PDF</label>
                                                <input type="file" value="{{ $dmtn->pdf }}" class="form-control @error('upload') is-invalid @enderror" name="upload" id="upload">
                                                @error('upload')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="col-lg-12">

                                    <button type="submit" id="form-submit" class="btn btn-primary btn-block">Submit</button>

                                </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection