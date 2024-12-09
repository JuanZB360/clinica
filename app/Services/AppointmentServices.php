<?php

namespace App\Services;

use App\Models\Appointment;
use App\Http\Requests\AppointmentRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AppointmentServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $user = Auth::user();

        if($user->hasRole('admin')) {
            $appointments = Appointment::where('status', true)
            ->where('fecha', '>=', Carbon::now())
            ->whereHas('users.roles', function ($role) {
                $role->where('name', 'doctor');
            })
            ->with('users')
            ->orderBy('users.name', 'asc')
            ->get();

            return view('templatesApp.appointments', compact('appointments'));
        }
        $appointments = $user->appointments()
        ->with(['users.roles'])
        ->where('status', true)
        ->where('fecha', '>=', Carbon::now())
        ->orderBy('fecha', 'asc')
        ->get();

        return view('templatesApp.appointments', compact('appointments'));

    }

    public function create()
    {
        $appointments = Appointment::where('appointment_date', '>=', Carbon::now())
        ->orderBy('appointment_date', 'asc')->pluck('appointment_date')->toArray();

        $appointments = array_map(function ($appointment) {
            return Carbon::parse($appointment)->format('Y-m-d H:i');
        }, $appointments);

        return view('templatesApp.appointmentsCreate', compact('appointments'));
    }

    public function store(AppointmentRequest $request)
    {
        $patient = User::where('identity_card', $request->identity_card)->first();
        
        if(!$patient) {
            return back()->withErrors(['identity_card' => 'Paciente no encontrado.']);
        }

        $doctor = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })
        ->whereDoesntHave('appointments', function ($query) use ($request) {
            $query->where('appointment_date', '=', $request->appointment_date)
                  ->where('status', true);
        })
        ->first();

        if(!$doctor) {
            return back()->withErrors(['appointment_date' => 'No hay citas disponible en esa fecha selecciona otra.']);
        }

        $appointment = Appointment::create([
            'reason' => $request->reason,
            'appointment_date' => Carbon::parse($request->appointment_date),
        ]);

        $appointment->users()->attach($patient->id);
        $appointment->users()->attach($doctor->id);

        return back()->with('success', 'La cita se agendo Correctamente');

    }

    public function show(string $id)
    {}

    public function edit(string $id)
    {}

    public function update(Request $request, string $id)
    {}

    public function destroy(string $id)
    {}
}
