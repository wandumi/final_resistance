@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </div>

    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                @can('user.create')
                    <a class="m-0 float-right btn btn-secondary btn-sm" href="{{ url('users/create') }}">Add User <i
                        class="fas fa-chevron-right"></i></a>
                @endcan
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="usersTable">
                    <thead class="thead-light">
                    <tr>
                      
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Email</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                               
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->slug }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->permission == 'admin')
                                        <span class="badge badge-secondary">Admin</span>
                                    @elseif ($user->permission == 'marketing')
                                        <span class="badge badge-warning">Marketing</span>
                                    @else
                                        <span class="badge badge-primary">User</span>
                                    @endif    
                                </td>
                                <td>
                                    @can('edit', $user)
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                    @endcan
                                    @can('delete', $user)
                                        <a href="#" class="btn btn-sm btn-danger" id="userDelete" data-user-delete="{{ $user->id }}">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    
                    
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#usersTable').DataTable();
        
            $('#usersTable').on('click','#userDelete', function (){

                var userDelete = $(this).data('user-delete');
                var token = $("meta[name='csrf-token']").attr("content");

                if(confirm("Are you sure, you want to remove it?")){
                    $.ajax({
                        type: "DELETE",
                        url: "users/" + userDelete,
                        data: {
                            "id": userDelete,
                            "_token": token,
                        },
                        success: function(response) {
                            console.log(response.message);

                            if(response.message == "Success"){
                                
                                alert('Successfully Deleted..');

                                setInterval(() => {
                                    location.reload();
                                }, 500);
                                
                            } else if(response.error == "Deleted"){

                                alert('You can not delete Administrator');
                            }
                        },
                        error: function(response){
                            console.log(response.error);

                        }
                    });
                }
            });

            
        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        } 

        function errorMessage(message){
            toastr.error(message, 'Event');
        }
    </script>
@endsection
