@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
<div class="container align-center">
    <div class="row text-center ">
    <div class="col-md-3"> </div>
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">Schedule Appointment</div>
<?php
/*date_default_timezone_set('Asia/Kolkata');
$date = date('m/d/Y h:i:s a', time());
//echo $date;


//echo date("h:i:sa");
//$addingFiveMinutes= strtotime( $date.' + 60 minute');

$s_time=9;
$e_time=18;

$slot=13;
$t_slot=$slot;


$t_stime=9;
$t_etime=18;
while($t_stime<$e_time){
    $t_slot=$slot;
  
    $mod_r=60%$slot;
    if($mod_r==0){
        echo $t_stime." 00 "."</br> ";


        while($t_slot<60){
            echo $t_stime." ".$t_slot."</br> ";
            $t_slot+=$slot;
        }
    
        $t_stime=$t_stime+1;
    }else{
        
       // echo $t_stime." 00 "."</br> ";


        while($t_slot<=60){
            echo $t_stime." ".$t_slot."</br> ";
            $t_slot+=$slot;
        }
    
        $t_stime=$t_stime+1;
    }
    
}
//echo $addingFiveMinutes;

*/
?>
            <div class="card-body">
                <label class="label "> Select Date</label>
            <input type="date" class="form-control" id="appointment_date" />
</br>
         
            <div class="appointmnets">
            </div>

           
            </div>
        </div>
        </div>
     
      
    </div>
</div>
@endsection
<script>

$(document).ready(function(){



    var slot;
    var break_start;
    var break_duration;
   /* $.post("{{route('user.deriveCalender')}}",
    {
      _token: "{{ csrf_token() }}",
     },
    function(data,status){
      console.log(data);
        $(".appointmnets").html(data);
     // alert("Data: " + data + "\nStatus: " + status);
    });
*/

    $("#appointment_date").change(function () {
        console.log(this.value);
        $.post("{{route('user.deriveCalender')}}",
        {
            _token: "{{ csrf_token() }}",
            appointment_date:this.value
        },function(data,status){
            console.log(data);
            $(".appointmnets").html(data);

          
        });
    });

  $(".app_btn").click(function(a){
      
    console.log(a);
      
      /*
    $.post("",
    {
      _token: "{{ csrf_token() }}",
      start_time:$("#appointment_slot").val(),
      end_time: $("#break_time").val(),
      start_at:$("#start_at").val()

    },
    function(data,status){
        console.log("data",data);
     // alert("Data: " + data + "\nStatus: " + status);
    });

    */
  });
});


function save(a){
    console.log(a.textContent);
    $.post("{{route('user.saveAppointment')}}",
        {
            _token: "{{ csrf_token() }}",
            appointment_date:$("#appointment_date").val(),
            time:a.textContent
        },function(data,status){
            console.log(data);
            //$(".appointmnets").html(data);

          $.post("{{route('user.deriveCalender')}}",
        {
            _token: "{{ csrf_token() }}",
            appointment_date:$("#appointment_date").val()
        },function(data,status){
            console.log(data);
            $(".appointmnets").html(data);

          
        });
    });
}

</script>
