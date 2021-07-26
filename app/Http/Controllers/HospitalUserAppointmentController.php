<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HospitalUserAppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user_dashboard');
    }

    public function updateSchedule(Request $request){
     
        
         $data=DB::table('tblappointmentschedule')
            ->where('sr_no', 1)
            ->update(['break_time' => $request['break_time'],"break_start"=>$request['start_at'],"slot"=>$request['appointment_slot']]);
 
        // DB::table('tblnewsletter')->insert($newsletter_batch); 
         return json_encode($data);
    }

    public function getSchedule(Request $request){
        $appointment = DB::table('tblappointmentschedule')->get();

        return  json_encode($appointment);;
    }

    public function deriveCalender(Request $request){
        $schedule = DB::table('tblappointmentschedule')->get();
        $appointments = DB::table('tblappointment')->where('appointment_date', '=', $request['appointment_date'])->get(['start_time','end_time']);
        $slot;
        $lunch_break;
            foreach($schedule as $d){
               $slot= $d->slot;
               $lunch_break=$d->break_start;
               $lunch_duration=$d->break_time;
            }
        $calender_array=array();
       

        $calender_buttons="";

        date_default_timezone_set('Asia/Kolkata');
            $date = date('m/d/Y h:i:s a', time());
            $s_time=9;
            $e_time=18;

           // $slot=13;
            $t_slot=$slot;


            $t_stime=9;
            $t_etime=18;
            while($t_stime<$e_time){
                $t_slot=$slot;
            
                $mod_r=60%$slot;
                //if($mod_r==0){
                    array_push($calender_array,$t_stime." 00");
                   // echo $t_stime." 00 "."</br> ";
                   $already_booked=false;
                   foreach($appointments as $ap){
                        if($ap->start_time==$t_stime){
                            $calender_buttons.="<br/><button class='btn btn-success btn-sm form-control app_btn' onclick='save(this)' disabled>".$t_stime.":00:00"."</button>";
                            $already_booked=true;
                            break;
                        }
                    }

                    if($already_booked==false){
                        $calender_buttons.="<br/><button class='btn btn-primary btn-sm form-control app_btn'  onclick='save(this)' >".$t_stime.":00:00"."</button>";
                    }
                   if($t_stime==$lunch_break){
                        $calender_buttons.="<br/><button class='btn btn-danger btn-sm form-control app_btn'   >Lunch Break</button>";
                    }

                  
                //}

                    while($t_slot<60){
                        //echo $t_stime." ".$t_slot."</br> ";
                        array_push($calender_array,$t_stime." ".$t_slot);
                        
                        $already_booked=false;
                        foreach($appointments as $ap){
                             if($ap->start_time==$t_stime.":".$t_slot.":00"){
                                 $calender_buttons.="<br/><button class='btn btn-success btn-sm form-control app_btn'  disabled>".$t_stime.":".$t_slot.":00"."</button>";
                                 $already_booked=true;
                                 break;
                             }
                         }
     
                         if($already_booked==false){
                             $calender_buttons.="<br/><button class='btn btn-primary btn-sm form-control app_btn' onclick='save(this)'  >".$t_stime.":".$t_slot.":00"."</button>";
                         }
                        if($t_stime.":".$t_slot.":00"==$lunch_break){
                             $calender_buttons.="<br/><button class='btn btn-danger btn-sm form-control app_btn'  >Lunch Break</button>";
                         }
     
                      //  $calender_buttons.="<button class='btn btn-primary btn-sm' >".$t_stime.":".$t_slot.":00"."</button>";
                   
                  

                        $t_slot+=$slot;
                    }
                
                    $t_stime=$t_stime+1;
              
    
            }

            return   $calender_buttons;
    }
    public function getAppointments(Request $request){
       // return "hello";
        
        $data = DB::table('tblappointment')->where("pid",auth()->user()->id)->paginate(10);
        
        return view("userappoinments",["data"=>$data]);

    }

    public function saveAppointment(Request $request){
        $userAppointment = array(
            "start_time"=>$request["time"], 
            "pid"=>1,
            "appointment_date"=>$request['appointment_date']
            );
        DB::table('tblappointment')->insert($userAppointment); 
            return $userAppointment;

    }




}
