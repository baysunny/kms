<x-layout>
    Add patient
    <form action="/dashboard/appointments" class="form-floating mt-4" method="POST">
    @csrf

    @error('patient_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('schedule')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('status')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('note')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingName" name="patient_id">
            @foreach($patients as $patient)
            <option value="{{$patient->id}}">{{$patient->name}}</option>
            @endforeach
        </select>
        <label for="floatingName">Patient Name</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingDateOfBirth" name="schedule" value="{{old('schedule')}}">
        <label for="floatingDateOfBirth">Schedule</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingStatus" name="status">
            <option value="waiting">Waiting</option>
            <option value="canceled">Canceled</option>
        </select>
        <label for="floatingStatus">Status</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" name="note" style="min-height: 5.5rem" placeholder="{{old('note')}}" id="floatingNote">{{old('note')}}</textarea>

        <label for="floatingNote">Note</label>
    </div>

    <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Add</button>
</form>

</x-layout>