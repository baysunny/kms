<x-layout>
	<a href="/dashboard/patients/create" class="btn btn-primary"><i class="fa fa-plus"></i> Add Patient</a>
	@if(count($patients)!=0)
	<form action="/dashboard/patients">
		<div class="input-group my-3">
		  <button class="btn btn-primary" type="submit" id="button-addon1"><i class="fa fa-search"></i></button>
		  <input name="search" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
		</div>
	</form>
	
	<table class="table table-default">
	  <thead>
	    <tr>
	      <!-- <th scope="col">#</th> -->
	      <th scope="col">ID</th>
	      <th scope="col">Name</th>
	      <th scope="col">Date of birth</th>
	      <th scope="col">Gender</th>
	      <th scope="col">Address</th>
	      <th scope="col">Contact</th>
	      <th scope="col" colspan="2">Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($patients as $patient)
	    <tr>
	      <!-- <th scope="row">1</th> -->
	      <td>{{$patient->id}}</td>
	      <td><a href="/dashboard/patients/{{$patient->id}}/appointments">{{$patient->name}}</a></td>
	      <td>{{date ( 'd/M/Y' , strtotime($patient->date_of_birth) )}}</td>
	      <td>{{$patient->gender}}</td>
	      <td>{{$patient->address}}</td>
	      <td>{{$patient->contact}}</td>
	      <td>
	      	<a href="/dashboard/patients/{{$patient->id}}/edit" class="btn btn-sm btn-link text-success">Edit</a>
	      </td>
	      <td>
			<form method="POST" action="/dashboard/patients/{{$patient->id}}" class="d-flex">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-link text-danger">Delete</button>
            </form>
           </td>
	    </tr>
		@endforeach
	  </tbody>
	</table>
	@else
	<h1>
		There is no patient
	</h1>
	@endif
	<div class="d-flex">
		{{ $patients->links() }}
	</div>

</x-layout>