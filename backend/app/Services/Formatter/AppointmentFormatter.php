<?php

namespace App\Services\Formatter;

use App\Enums\Repetition;

class AppointmentFormatter implements AppointmentFormatterInterface
{
    public function format($appointments)
    {
        $formattedAppointments = [];

        foreach ($appointments as $appointment) {
            $formattedAppointment = [];
            $formattedAppointment['display'] = 'background';

            if ($appointment->repetition === Repetition::NoRepetition) {
                $formattedAppointment['start'] = $appointment->start_time;
                $formattedAppointment['end'] = $appointment->end_time ? $appointment->end_time : null;
            } else {
                $formattedAppointment['rrule'] = [
                    'freq' => 'weekly',
                    'dtstart' => $appointment->start_time,
                    'byweekday' => $appointment->day_of_week,
                ];

                if ($appointment->repetition === Repetition::EvenWeek || $appointment->repetition === Repetition::OddWeek) {
                    $formattedAppointment['rrule']['wkst'] = $appointment->repetition === Repetition::EvenWeek ? 'mo' : 'su';
                    $formattedAppointment['rrule']['interval'] = 2;
                }

                if ($appointment->end_time) {
                    $formattedAppointment['rrule']['until'] = $appointment->end_time;
                }

                $formattedAppointment['duration'] = $appointment->time_within_day;
            }

            $formattedAppointments[] = $formattedAppointment;
        }

        return $formattedAppointments;
    }
}
