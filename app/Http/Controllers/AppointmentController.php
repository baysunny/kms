<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use PDF;


class AppointmentController extends Controller
{
    public function export_pdf($start = null, $end = null){
        $appointments = Appointment::leftjoin('patients', 'patients.id', '=', 'appointments.patient_id')
            ->select('appointments.*', 'patients.name as patient_name')
            ->latest()
            ->filter(request(['start' => $start, 'end' => $end]))
            ->get();
        $pdf = PDF::loadView('pdf.appointments', [
            'appointments'=> $appointments
        ]);
        return $pdf->download('appointments.pdf');
        // return view('pdf.appointments', [
        //     'appointments'=> $appointments
        // ]);
    }
    public function index()
    {
        return view('dashboard.appointments.index', [
            'appointments' => Appointment::leftjoin('patients', 'patients.id', '=', 'appointments.patient_id')
            ->select('appointments.*', 'patients.name as patient_name')
            ->latest()
            ->filter(request(['start', 'end']))
            ->paginate(6)
        ]);
    }

    public function create()
    {
        return view('dashboard.appointments.create', [
            'patients' => Patient::orderBy('name')->get()
        ]);
    }

    public function store(Request $request, Appointment $appointment)
    {
        if (auth()->check()) {
            $formFields = $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'schedule' => 'required|date',
                'status' => 'required|in:waiting,showup,canceled',
                'note' => 'required'
            ]);
            
            Appointment::create($formFields);

            return redirect('/dashboard/appointments')->with('message', 'Appointment added!');
        }else{
            return redirect('/login')->with('error', 'You need to login');         
        }
    }

    public function cancelAppointment(Request $request, $id){
        if (auth()->check()) {
            $appointment = Appointment::find($id);

            if ($appointment) {
                $appointment->update(['status' => 'canceled']);
                return redirect('/dashboard/appointments')->with('message', 'Appointment canceled successfully!');
            } else {
                return redirect('/dashboard/appointments')->with('error', 'Appointment not found.');
            }
        }else{
            return redirect('/login')->with('error', 'You need to login');         
        }
    }
}
