@extends('layouts.app')

@section('header')

        
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Dmtn Sections</h5>
                    <a href="{{ url('dmtns/dmtn_sections') }}" class="btn btn-sm btn-primary">Back</a>
                </div>
                    <div class="col-lg-6 offset-lg-3 my-5">
                        @if($message =  session('message'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <form id="dmtnList" action="{{ route('dmtn_sections.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                            id="name" placeholder="Enter DMTNs section Name*" value="{{ old('name') }}">
                                    @error('name')
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

@section('footer')

    <script>
        $(document).ready(function(){
            alert("Juuery running");
            //function to hideResponse
            function hideResponse(){
                setTimeout(() => {
                   $('#response').slideUp('#low', function(){}) 
                }, 2000);
            }

            $('#response').hide();

            $(function(){
                $('#list .sections').sortable({ opacity: 0.5, cursor: 'move', update: function(){
                        var order = $(this).sortable("serialize") + '&update=order';

                        $.post("update.php", order, function(response){
                            $('#response').html(response);
                            $('#response').slideDown('slow');
                            hideResponse();
                        });
                    }
                })
            })
            
        });
    </script>

@endsection