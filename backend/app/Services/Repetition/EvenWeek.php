<?php

namespace App\Services\Repetition;

use App\Models\Appointment;
use App\Models\Reservation;

class EvenWeek extends Weekly
{
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        return parent::isBookableTime($appointment, $reservation) &&
            $this->isEvenWeek($reservation);
    }

    private function isEvenWeek(Reservation $reservation): bool
    {
        return $reservation->start->weekOfYear % 2 === 0;
    }
}