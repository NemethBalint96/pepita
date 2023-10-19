<?php

namespace App\Services\Repetition;

use App\Models\Appointment;
use App\Models\Reservation;

class OddWeek extends Weekly
{
    /**
     * Check if a reservation is bookable within an appointment for odd weeks.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return bool
     */
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        return parent::isBookableTime($appointment, $reservation) &&
            $this->isOddWeek($reservation);
    }

    /**
     * Check if a reservation falls in an odd week.
     *
     * @param Reservation $reservation
     * @return bool
     */
    private function isOddWeek(Reservation $reservation): bool
    {
        return $reservation->start->weekOfYear % 2 === 1;
    }
}
