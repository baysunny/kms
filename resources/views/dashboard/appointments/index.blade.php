<x-layout>
	<a href="/dashboard/appointments/create" class="btn btn-primary"><i class="fa fa-plus"></i> Add Appointment</a>
	@if(count($appointments)!=0)
	<div class="row">
		<div class="col-lg-6">
			<form action="/dashboard/appointments">
				<div class="input-group my-3">
				  <input id="floatingDateOfBirth" name="start" type="text" class="form-control" placeholder="Start" aria-label="Start" value="{{ request('start') }}">
				  <span class="input-group-text"><i class="fa fa-arrow-right"></i></span>
				  <input id="floatingDateOfBirth" name="end" type="text" class="form-control" placeholder="End" aria-label="End" value="{{ request('end') }}">
				  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</div>
			</form>
		</div>
	 </div>
	<table class="table table-default table-responsive appointment-table table-hover">
	  <thead>
	    <tr>
	      <!-- <th scope="col">#</th> -->
	      <th scope="col">ID</th>
	      <th scope="col">Patient Name</th>
	      <th scope="col">Date/Schedule</th>
	      <th scope="col">Status</th>
	      <th scope="col">Note</th>
	      <th scope="col" colspan="3" class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($appointments as $appointment)
	    <tr>
	      <!-- <th scope="row">1</th> -->
	      <td>{{$appointment->id}}</td>
	      <td><a href="/dashboard/patients/{{$appointment->patient_id}}/appointments">{{$appointment->patient_name}}</a></td>
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
	      <td>
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
          </td>
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
		<a class="btn btn-primary" href="/dashboard/appointments/exportPDF?start={{ request('start') }}&end={{ request('end') }}"><i class="fa fa-file-pdf"></i> Download Report</a>
	</div>

</x-layout>