<?php

namespace App\Services\Repetition;

use App\Models\Appointment;
use App\Models\Reservation;

class EvenWeek extends Weekly
{
    /**
     * Check if a reservation is bookable within an appointment for even weeks.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return bool
     */
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        return parent::isBookableTime($appointment, $reservation) &&
            $this->isEvenWeek($reservation);
    }

    /**
     * Check if a reservation falls in an even week.
     *
     * @param Reservation $reservation
     * @return bool
     */
    private function isEvenWeek(Reservation $reservation): bool
    {
        return $reservation->start->weekOfYear % 2 === 0;
    }
}
