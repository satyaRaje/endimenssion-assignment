<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HospitalAdminController extends Controller
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
        return view('admin_dashboard');
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


    public function getAppointments(Request $request){
        // return "hello";
         $appointments = DB::table('tblappointment')->where('appointment_date', '=', $request['appointment_date'])->get(['start_time','end_time']);
         $data=array();
         //return  json_encode($appointments);
         $data = DB::table('tblappointment')
         ->join('users', 'tblappointment.pid', '=', 'users.id')->paginate(10);
         
         return view("appointments",["data"=>$data]);
 
     }


}
