<x-layout>
    Add patient
    <form action="/dashboard/appointments" class="form-floating mt-4" method="POST">
    @csrf

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingName" name="patient_id">
            @foreach($patients as $patient)
            <option value="{{$patient->id}}">{{$patient->name}}</option>
            @endforeach
        </select>
        <label for="floatingName">Patient Name</label>
        @error('patient_id')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingDateOfBirth" name="schedule" value="{{old('schedule')}}">
        <label for="floatingDateOfBirth">Schedule</label>
        @error('schedule')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingStatus" name="status">
            <option value="waiting">Waiting</option>
            <option value="canceled">Canceled</option>
        </select>
        <label for="floatingStatus">Status</label>
        @error('status')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" name="note" style="min-height: 5.5rem" placeholder="{{old('note')}}" id="floatingNote">{{old('note')}}</textarea>
        <label for="floatingNote">Note</label>
        @error('note')
        <p class="text-danger px-1"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Add</button>
</form>

</x-layout>