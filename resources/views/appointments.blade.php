@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
<div class="container align-center">
    <h3 class="text-center">Appoinments</h3>
    <div class="row text-center ">
    <table class="table ">
        <tr class="bg-dark text-light">
            <td>#Sr No</td>
            <td>Name</td>
            <td>Email</td>
            <td>Time</td>
            <td>Date</td>
        </tr>

        @foreach ($data as $d)
        <tr>
            <td>{{$d->sr_no}}</td>
            <td>{{$d->name}}</td>
            <td>{{$d->email}}</td>
            <td>{{$d->start_time}}</td>
            <td>{{$d->appointment_date}}</td>
        </tr>

        @endforeach
        

    <table> 

{{$data->links()}}



    </div>
</div>
@endsection
