<!DOCTYPE html>
<html>
<head>
<style>
.title{
	text-align: center;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1 class="title">List Appointment</h1>

@php
	$n = 0;
@endphp

@if(request('start') && request('end'))
		@php
	    $startDate = \Carbon\Carbon::parse(request('start'))->format('d M Y');
	    $endDate = \Carbon\Carbon::parse(request('end'))->format('d M Y');
    @endphp
    <h1 class="title">{{ $startDate }} - {{ $endDate }}</h1>
@endif


@if(count($appointments) != 0)
<table id="customers">
  	<tr>
	  <th scope="col">#</th>
	  <th scope="col">ID</th>
	  <th scope="col">Patient Name</th>
	  <th scope="col">Date/Schedule</th>
	  <th scope="col">Status</th>
	  <th scope="col">Note</th>
	</tr>
	@foreach($appointments as $appointment)
	<tr>
	  <th scope="row">{{ $n+=1 }}</th>
	  <td>{{$appointment->id}}</td>
	  <td>{{$appointment->patient_name}}</td>
	  <td>{{date ( 'd/M/Y' , strtotime($appointment->schedule) )}}</td>
	  <td>{{$appointment->status}}</td>
	  <td>{{$appointment->note}}</td>
	</tr>
	@endforeach
</table>
@else
<h1> Appointment </h1>
@endif
</body>
</html>


