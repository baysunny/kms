<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDF;

class PatientController extends Controller
{
    public function export_pdf(Patient $patient){
        $appointments = Appointment::leftjoin('patients', 'patients.id', '=', 'appointments.patient_id')
            ->select('appointments.*', 'patients.name as patient_name')
            ->latest()
            ->get();
        $pdf = PDF::loadView('pdf.patient-appointments', [
            'patient' => $patient,
            'appointments'=> $appointments
        ]);
        return $pdf->download('patient-appointments.pdf');
        // return view('pdf.patient-appointments', [
        //     'patient' => $patient,
        //     'appointments'=> $appointments
        // ]);
    }

    public function index()
    {
        return view('dashboard.patients.index', [
            'patients' => Patient::latest()->filter(request(['search']))->paginate(6)
        ]);
    }

    public function edit(Patient $patient)
    {
        return view('dashboard.patients.edit', ['patient'=>$patient]);
    }

    public function create(Patient $patient)
    {
        return view('dashboard.patients.create');
    }

    public function appointments(Patient $patient)
    {
        return view('dashboard.patients.appointments', [
            'patient' => $patient,
            'appointments' => Appointment::where('patient_id', '=', $patient->id)
                ->latest()
                ->paginate(6)
        ]);
    }


    public function store(Request $request, Patient $patient)
    {
        if (auth()->check()) {
            $formFields = $request->validate([
                'name' => 'required',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female',
                'address' => 'required',
                'contact' => 'required',

            ]);
            
            Patient::create($formFields);

            return redirect('/dashboard/patients')->with('message', 'Patient added!');
        }else{
            return redirect('/login')->with('error', 'You need to login');         
        }
    }

    public function update(Request $request, Patient $patient)
    {
        if (auth()->check()) {
            $formFields = $request->validate([
                'name' => 'required',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female',
                'address' => 'required',
                'contact' => 'required',
            
            ]);
            
            $patient->update($formFields);
            return redirect('/dashboard/patients')->with('message', 'Patient updated successfully');
        }else{
            return redirect('/login')->with('error', 'You need to login');         
        }
    }

    public function destroy(Patient $patient){
        if (auth()->check()) {
            $patient->delete();
            return redirect('/dashboard/patients')->with('message', 'Patient deleted successfully');
        }else{
            return redirect('/login')->with('error', 'You need to login');         
        }
    }
}
