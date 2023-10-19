<?php

namespace App\Services;

use App\Models\Reservation;

interface BookingServiceInterface
{
    /**
     * Check if a reservation is bookable.
     *
     * @param Reservation $reservation
     * @return bool
     */
    public function isBookable(Reservation $reservation): bool;
}