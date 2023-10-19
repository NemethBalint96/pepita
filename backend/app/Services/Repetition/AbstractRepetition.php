<?php

namespace App\Services\Repetition;

use App\Models\Appointment;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Common\DateTimeFormat;
use App\Enums\Repetition;
use Carbon\CarbonInterval;

abstract class AbstractRepetition
{
    /**
     * Check if a reservation is bookable within an appointment.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return bool
     */
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        $appointmentStartDate = Carbon::parse($appointment->start_time);
        if ($appointmentStartDate->greaterThan($reservation->start)) {
            return false;
        }

        if ($appointment->end_time) {
            $appointmentEndDate = Carbon::parse($appointment->end_time);
            if ($appointmentEndDate->lessThan($reservation->end)) {
                return $this->isFreeAppointmentAfter($reservation, $appointmentEndDate);
            }
        }

        return true;
    }

    /**
     * Check if there is a free appointment after the original appointment's end time.
     *
     * @param Reservation $reservation
     * @param Carbon $originalAppointmentEnd
     * @return bool
     */
    private function isFreeAppointmentAfter(Reservation $reservation, Carbon $originalAppointmentEnd): bool
    {
        $appointments = Appointment::all();
        foreach ($appointments as $appointment) {
            if ($appointment->repetition === Repetition::NoRepetition) {
                // Check for non-repeating appointments.
                $secondAppointmentStart = Carbon::parse($appointment->start_time);
                if ($originalAppointmentEnd->equalTo($secondAppointmentStart)) {
                    if ($appointment->end_time) {
                        $secondAppointmentEndDate = Carbon::parse($appointment->end_time);
                        if ($secondAppointmentEndDate->greaterThanOrEqualTo($reservation->end)) {
                            return true;
                        }
                    }
                }
            } else if ($appointment->repetition === Repetition::Weekly) {
                // Check for weekly repeating appointments.
                if ($reservation->start->dayOfWeekIso - 1 === $appointment->day_of_week) {
                    $appointmentStartTime = Carbon::parse($reservation->start);
                    $appointmentStartTime->setTimeFromTimeString(Carbon::parse($appointment->start_time)->toTimeString());
                    $interval = CarbonInterval::createFromFormat(DateTimeFormat::TIME_FORMAT, $appointment->time_within_day);
                    $appointmentEndTime = Carbon::parse($appointmentStartTime);
                    $appointmentEndTime->add($interval);
                    if ($appointmentStartTime->equalTo($originalAppointmentEnd) && $appointmentEndTime->greaterThanOrEqualTo($reservation->end)) {
                        return true;
                    }
                }
            } else {
                // Check for bi-weekly repeating appointments.
                if ($reservation->start->dayOfWeekIso - 1 === $appointment->day_of_week) {
                    $appointmentStartTime = Carbon::parse($reservation->start);
                    $appointmentStartTime->setTimeFromTimeString(Carbon::parse($appointment->start_time)->toTimeString());
                    $interval = CarbonInterval::createFromFormat(DateTimeFormat::TIME_FORMAT, $appointment->time_within_day);
                    $appointmentEndTime = Carbon::parse($appointmentStartTime);
                    $appointmentEndTime->add($interval);
                    if ($appointmentStartTime->equalTo($originalAppointmentEnd) && $appointmentEndTime->greaterThanOrEqualTo($reservation->end)) {
                        if ($appointment->repetition === Repetition::EvenWeek && $reservation->start->weekOfYear % 2 === 0) {
                            return true;
                        } else if ($appointment->repetition === Repetition::OddWeek && $reservation->start->weekOfYear % 2 === 1) {
                            return true;
                        }
                    }
                }
            } 
        }

        return false;
    }
}