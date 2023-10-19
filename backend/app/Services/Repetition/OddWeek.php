<?php

namespace App\Services\Repetition;

use App\Models\Appointment;
use App\Models\Reservation;

class OddWeek extends Weekly
{
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        return parent::isBookableTime($appointment, $reservation) &&
            $this->isOddWeek($reservation);
    }

    private function isOddWeek(Reservation $reservation): bool
    {
        return $reservation->start->weekOfYear % 2 === 1;
    }
}