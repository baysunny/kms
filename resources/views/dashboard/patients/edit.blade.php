<x-layout>
	Edit patient : <strong>{{$patient->name}}</strong> / Patient ID : <strong>{{$patient->id}}</strong>
	<form action="/dashboard/patients/{{$patient->id}}" class="form-floating mt-4" method="POST">
    @csrf
    @method('PUT')
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingName" name="name" value="{{$patient->name}}">
        <label for="floatingName">Name</label>
        @error('name')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingDateOfBirth" name="date_of_birth" value="{{$patient->date_of_birth}}">
        <label for="floatingDateOfBirth">Date of Birth</label>
        @error('date_of_birth')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingGender" name="gender">
            <option value="male" {{$patient->gender == 'male' ? 'selected' : ''}}>Male</option>
            <option value="female" {{$patient->gender == 'female' ? 'selected' : ''}}>Female</option>
        </select>
        <label for="floatingGender">Gender</label>
        @error('gender')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingAddress" name="address" value="{{$patient->address}}">
        <label for="floatingAddress">Address</label>
        @error('address')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingContact" name="contact" value="{{$patient->contact}}">
        <label for="floatingContact">Contact</label>
        @error('contact')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Update</button>
</form>

</x-layout>