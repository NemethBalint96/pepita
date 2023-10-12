<?php

namespace App\Http\Controllers;

use App\Models\Appointment;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        $formattedAppointments = [];

        foreach ($appointments as $appointment) {
            $formattedAppointment = [];
            $formattedAppointment['display'] = 'background';

            if ($appointment->repetition === 'no repetition') {
                $formattedAppointment['start'] = $appointment->start_time;
                $formattedAppointment['end'] = $appointment->end_time ? $appointment->end_time : null;
            } else {
                $formattedAppointment['rrule'] = [
                    'freq' => 'weekly',
                    'dtstart' => $appointment->start_time,
                    'byweekday' => $appointment->day_of_week,
                ];

                if ($appointment->repetition === 'even week' || $appointment->repetition === 'odd week') {
                    $formattedAppointment['rrule']['wkst'] = $appointment->repetition === 'even week' ? 'mo' : 'su';
                    $formattedAppointment['rrule']['interval'] = 2;
                }

                if ($appointment->end_time) {
                    $formattedAppointment['rrule']['until'] = $appointment->end_time;
                }

                $formattedAppointment['duration'] = $appointment->time_within_day;
            }

            $formattedAppointments[] = $formattedAppointment;
        }

        return response()->json(['appointments' => $formattedAppointments]);
    }
}
