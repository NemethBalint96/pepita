<?php

namespace App\Services\Repetition;

use App\Models\Appointment;
use App\Models\Reservation;

class NoRepetition extends AbstractRepetition
{
    /**
     * Check if a reservation is bookable within an appointment for non-repeating appointments.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return bool
     */
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        return parent::isBookableTime($appointment, $reservation);
    }
}
