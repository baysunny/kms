<!DOCTYPE html>
<html>
<head>
<style>
.title{
/*	text-align: center;*/
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

.clone-data-table{
    border-collapse: collapse;
    border: none;
    width: 100%;
}

.clone-data-table th, td{
    border: none;
    text-align: left;
    padding: .4rem;
}

.clone-data-table th{
    width: 20%;
}

</style>
</head>
<body>
	<h1 class="title">Patient Data</h1>
	<table class="clone-data-table mb-3">
		<tr>
			<th>Patient Name</th>
			<td>{{$patient->name}}</td>
		</tr>
		<tr>
			<th>Date of birth</th>
			<td>{{date ( 'd M Y' , strtotime($patient->date_of_birth) )}}</td>
		</tr>
		<tr>
			<th>Gender</th>
			<td>{{$patient->gender}}</td>
		</tr>
		<tr>
			<th>Address</th>
			<td>{{$patient->address}}</td>
		</tr>
		<tr>
			<th>Contact</th>
			<td>{{$patient->contact}}</td>
		</tr>
	</table>

<h1 class="title">List Appointment</h1>

@php
	$n = 0;
    
@endphp

@if(count($appointments) != 0)
<table id="customers">
  	<tr>
	  <th scope="col">#</th>
	  <th scope="col">ID</th>
	  <th scope="col">Date/Schedule</th>
	  <th scope="col">Status</th>
	  <th scope="col">Note</th>
	</tr>
	@foreach($appointments as $appointment)
	<tr>
	  <th scope="row">{{ $n+=1 }}</th>
	  <td>{{$appointment->id}}</td>
	  <td>{{date ( 'd M Y' , strtotime($appointment->schedule) )}}</td>
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


