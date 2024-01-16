<x-layout>
    Add patient
    <form action="/dashboard/patients" class="form-floating mt-4" method="POST">
    @csrf

    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('date_of_birth')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('gender')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('contact')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingName" name="name" value="{{old('name')}}">
        <label for="floatingName">Name</label>
    </div>

    <div class="form-floating mb-3" id="">
        <input type="text" class="form-control" id="floatingDateOfBirth" name="date_of_birth" value="{{old('date_of_birth')}}">
        <label for="floatingDateOfBirth">Date of Birth</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingGender" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <label for="floatingGender">Gender</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingAddress" name="address" value="{{old('address')}}">
        <label for="floatingAddress">Address</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingContact" name="contact" value="{{old('contact')}}">
        <label for="floatingContact">Contact</label>
    </div>

    <button type="submit" class="btn btn-primary">Add</button>
</form>

</x-layout>