<?php

namespace App\Services\Repetition;

use App\Common\DateTimeFormat;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Appointment;
use App\Models\Reservation;

class Weekly extends NoRepetition
{
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        if (parent::isBookableTime($appointment, $reservation)) {
            if ($reservation->start->dayOfWeekIso - 1 === $appointment->day_of_week) {
                $appointmentStartTime = Carbon::parse($reservation->start);
                $appointmentStartTime->setTimeFromTimeString(Carbon::parse($appointment->start_time)->toTimeString());
                $interval = CarbonInterval::createFromFormat(DateTimeFormat::TIME_FORMAT, $appointment->time_within_day);
                $appointmentEndTime = Carbon::parse($appointmentStartTime);
                $appointmentEndTime->add($interval);
                if ($appointmentStartTime->lessThanOrEqualTo($reservation->start) && $appointmentEndTime->greaterThanOrEqualTo($reservation->end)) {
                    return true;
                }
            }
        }

        return false;
    }
}