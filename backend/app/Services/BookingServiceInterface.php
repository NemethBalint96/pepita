<?php

namespace App\Services;

use App\Models\Reservation;

interface BookingServiceInterface
{
    public function isBookable(Reservation $reservation): bool;
}