@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Create Dmtn</h5>
                    <a href="{{ url('dmtns/dmtn') }}" class="btn btn-sm btn-primary">Back</a>
                </div>
                    <div class="col-lg-6 offset-lg-3 my-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="dmtn" action="{{ url('dmtns/dmtn') }}" method="post" enctype="multipart/form-data">
                            @csrf
    
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="dmtn_section_id">DMTNs Section</label>
                                    <select name="dmtn_section_id" class="form-control" id="dmtn_section_id">
                                        <option default disabled selected>Select Dmtn Section</option>
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
                                            id="name" placeholder="Enter PDF Name*" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="pdf">Pdf a File</label>
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
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

