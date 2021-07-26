<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminDashboard', 'HospitalAdminController@index')->name('admin.dashboard');


Route::post('/updateSchedule', 'HospitalAdminController@updateSchedule')->name('admin.updateSchedule');
Route::post('/getSchedules', 'HospitalAdminController@getSchedule')->name('admin.getSchedule');
Route::get('/get-all-appoinments', 'HospitalAdminController@getAppointments')->name('admin.getAppointments');


Route::get('/my-appoinments', 'HospitalUserAppointmentController@getAppointments')->name('user.getAppointments');


Route::post('/saveAppointment', 'HospitalUserAppointmentController@saveAppointment')->name('user.saveAppointment');
Route::get('/userDashboard', 'HospitalUserAppointmentController@index')->name('user.dashboard');

Route::post('/deriveCalender', 'HospitalUserAppointmentController@deriveCalender')->name('user.deriveCalender');

Route::post('/saveAppointment', 'HospitalUserAppointmentController@saveAppointment')->name('user.saveAppointment');

