@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
<div class="container align-center">
<h3 class="text-center">Current Schedule</h3>
    <div class="row text-center ">
     
    <div class="col-md-2"> </div>
    <div class="col-md-1"> </div>
        <div class="col-md-2">
            <div class="card">
                    <div class="card-header"> Slot (min)</div>
                        <div class="card-body">
                            <div class="loader">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                                </div>
                        
                            </div>
                            <div class="appointment_slot">
                            </div>

                        </div>
            </div>
        </div>         

        <div class="col-md-2">
            <div class="card">
                    <div class="card-header">Break Time  (min)</div>
                        <div class="card-body">
                        <div class="loader">
                        <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                          

                            <div class="break_time">
                            </div>
                        </div>
            </div>
        </div>         


        <div class="col-md-2">
            <div class="card">
                    <div class="card-header">Break Start At</div>
                        <div class="card-body">
                        <div class="loader">
                        <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            
                            <div class="break_start_at">
                            </div>
                        </div>
            </div>
        </div>         



    </div>
</br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Manage Schedule</div>

















                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                
                        <div class="form-group">
                        <label class="label">Appointment Slot (mins.)</label>
                            <input type="text" class="form-control" id="appointment_slot"  value="30"  placeholder="Appointment Slot (mins.)">
                        </div>
                    
                        
            

                    <div class="form-group">
                    <label class="label">Break Time  (mins.)</label>
                        <input type="time" class="form-control" id="break_time" value="30" placeholder="Break Time  (mins.)">
                    </div>
                                

                        <div class="form-group">
                        <label class="label">Break Start At</label>
                        <input type="time"  class="fomr-control" id="start_at" name="appt" min="09:00" max="18:00" required>
                        </div>
                    

                        <button class="btn btn-sm btn-primary float-right save">Save</button>
                        
                </div>

                
            </div>










        </div>
    </div>
</div>
@endsection
<script>

$(document).ready(function(){
    
    $.post("{{route('admin.getSchedule')}}",
    {
      _token: "{{ csrf_token() }}",
     },
    function(data,status){
        var ndata= JSON.parse(data);
            console.log(ndata);
        console.log(ndata[0].break_time)
        $(".loader").hide();
        $(".appointment_slot").text(ndata[0].slot);
        $(".break_time").text(ndata[0].break_time);
        $(".break_start_at").text(ndata[0].break_start);
     // alert("Data: " + data + "\nStatus: " + status);
    });



  $(".save").click(function(){
    $(".loader").show();
    $.post("{{route('admin.updateSchedule')}}",
    {
      _token: "{{ csrf_token() }}",
      appointment_slot:$("#appointment_slot").val(),
      break_time: $("#break_time").val(),
      start_at:$("#start_at").val()

    },
    function(data,status){
        console.log(data);
     // alert("Data: " + data + "\nStatus: " + status);
     $.post("{{route('admin.getSchedule')}}",
    {
      _token: "{{ csrf_token() }}",
     },
    function(data,status){
        var ndata= JSON.parse(data);
            console.log(ndata);
        console.log(ndata[0].break_time)
        $(".loader").hide();
        $(".appointment_slot").text(ndata[0].slot);
        $(".break_time").text(ndata[0].break_time);
        $(".break_start_at").text(ndata[0].break_start);
     // alert("Data: " + data + "\nStatus: " + status);
    });

    });
  });
});
</script>
