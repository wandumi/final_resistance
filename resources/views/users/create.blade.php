@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('users') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Create</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('users') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="propertiesTable" class="col-md-6 offset-lg-3 py-5 ">
                @if($message =  session('message'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif
                <form id="user" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Enter a Name*" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input name="email" type="text"  class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Enter Email*" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="permission">Role</label>
                            <select class="form-control @error('permission') is-invalid @enderror" name="permission" id="permission">
                                <option default disabled selected>Select a role</option>
                                @can('admin', $user)<option value="admin">Admin</option>@endcan
                                <option value="marketing">Marketing</option>
                                <option value="user">User</option>
                            </select>
                            @error('permission')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password"  class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Enter Password" value="{{ old('passord') }}">
                            @error('password')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input name="password_confirmation" type="password"  class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
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

