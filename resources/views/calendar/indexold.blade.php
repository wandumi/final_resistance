@extends('backend.app')


@section('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    
    <style>
        .fc-title{
            color: white;
        }

        .fc-day-grid-event .fc-time {
            display: none;
        }

    
        @media only screen and (max-width: 460px) {
            .fc-toolbar .fc-right {
                float: none;
            }

            .fc-toolbar .fc-left {
                margin-bottom: 1em;
            }

            .fc-toolbar .fc-center {
                margin-top: 1em;
            } 

            .fc-toolbar {
                margin: 0 auto;
            }
        }
    </style>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </div>
    <!-- creating  -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                
            </div>
            <div id="calendar" class="col-md-10 offset-lg-1 py-lg-5 mb-5">
                  
            </div>
            <div class="card-footer align-items-center">
                <div style="text-align: center; font-weight: 600; ">
                    Note: On a touch device, for the user to begin drag-n-dropping events, they must first tap-and-hold on the event in order to “select” it!
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
        $(document).ready(function () {
        
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);

            console.log(booking);

            
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                // add
                select: function (start, end, allDay) {
                    $('#viewEvents').modal('toggle');

                    $('#save_events').click(function(){
                        var title = $('#title').val();
                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date   = moment(end).format('YYYY-MM-DD');
                        
                        $.ajax({
                            url: "{{ route('calendar.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                title,
                                start_date,
                                end_date,
                            },
                            
                            success: function (response) {
                                $('#viewEvents').modal('hide');
                                displayMessage("Event Added Successfully");

                                setInterval(() => {
                                    location.reload();
                                }, 500);
                                
                                $('#calendar').fullCalendar('renderEvent',{
                                    id: response.id,
                                    title: response.title,
                                    start: response.start,
                                    end: response.end
                                });

                               

                            },
                            error: function(error){
                                if(error.responseJSON.errors){
                                    $('#titleError').html(error.responseJSON.errors.title);
                                }
                            }
                        });

                    });
                  
                },

                // update
                eventDrop: function(event){
                 
                    var id = event.id;
                    var start = moment(event.start).format('YYYY-MM-DD');
                    var end   = moment(event.end).format('YYYY-MM-DD');

                    $.ajax({
                            url: "{{ route('calendar.update', '') }}" + "/" + id,
                            type: "PATCH",
                            dataType: 'json',
                            data: {
                                start: start,
                                end: end,
                            },
                            
                            success: function (response) {
                                displayMessage("Event Updated Successfully");
                                setInterval(() => {
                                    location.reload();
                                }, 500);
                            },
                            error: function(error){
                                console.log(error);
                                errorMessage("There was an error, please try again later");
                            }
                        });
                },

                // delete
                eventClick: function(event){
                    var id = event.id;

                    if(confirm("Are you sure, you want to remove it?")){

                        $.ajax({
                            url: "{{ route('calendar.destroy', '') }}" + "/" + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function (response) {

                                $('#calendar').fullCalendar('removeEvents', response);

                                displayMessage("Event Deleted Successfully");

                                setInterval(() => {
                                    location.reload();
                                }, 500);
                            },
                            error: function(error){
                                errorMessage("There was an error, please try again later");
                            }
                        });
                    }



                }

            

            });

            $('#calendar').addTouch();

        });
        
        function displayMessage(message) {
            toastr.success(message, 'Event');
        } 

        function errorMessage(message){
            toastr.error(message, 'Event');
        }
      
</script>
@endsection
