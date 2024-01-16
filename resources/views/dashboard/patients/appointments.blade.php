<x-layout>
	<a href="/dashboard/appointments/create" class="btn btn-primary"><i class="fa fa-plus"></i> Add Appointment</a>
	<h3 class="mt-3">Patient</h3>
	<table class="table clone-data-table mb-3">
		<tr>
			<th>Patient Name</th>
			<td>{{$patient->name}}</td>
		</tr>
		<tr>
			<th>Date of birth</th>
			<td>{{$patient->date_of_birth}}</td>
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

	<h3>History Appointments</h3>
	@if(count($appointments)!=0)
	
	<table class="table table-default table-responsive appointment-table table-hover">
	  <thead>
	    <tr>
	      <!-- <th scope="col">#</th> -->
	      <th scope="col">ID</th>
	      <th scope="col">Date/Schedule</th>
	      <th scope="col">Status</th>
	      <th scope="col">Note</th>
	      <th scope="col">Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($appointments as $appointment)
	    <tr>
	      <!-- <th scope="row">1</th> -->
	      <td>{{$appointment->id}}</td>
	      <td>{{date ( 'd M Y' , strtotime($appointment->schedule) )}}</td>
	      <td>{{$appointment->status}}</td>
	      <td>{{$appointment->note}}</td>
		  <td>
			<form method="POST" action="/dashboard/appointments/{{$appointment->id}}" class="d-flex">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm btn-link text-danger">Cancel</button>
            </form>
          </td>
	      <!-- <td>
			<form method="POST" action="/dashboard/appointments/{{$appointment->id}}" class="d-flex">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-link text-primary">Show up</button>
            </form>
          </td>
          <td>
			<form method="POST" action="/dashboard/appointments/{{$appointment->id}}" class="d-flex">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-link text-warning">No show</button>
            </form>
          </td> -->
	    </tr>
		@endforeach
	  </tbody>
	</table>
	@else
	<h1>
		There is no appointment
	</h1>
	@endif
	<div class="d-flex">
		{{ $appointments->links() }}
	</div>
	<div>
		<a class="btn btn-primary" href="/dashboard/patients/{{$patient->id}}/appointments/exportPDF"><i class="fa fa-file-pdf"></i> Download Report</a>
	</div>
</x-layout>