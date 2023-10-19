<?php

namespace App\Services\DAL;

use App\Models\Reservation;
use App\Services\Formatter\ReservationFormatterInterface;

class ReservationService implements ReservationServiceInterface
{
    protected $reservationFormatter;

    public function __construct(ReservationFormatterInterface $reservationFormatter)
    {
        $this->reservationFormatter = $reservationFormatter;
    }

    public function getAll()
    {
        $reservations = Reservation::all();
        $formattedReservations = $this->reservationFormatter->format($reservations);
        return $formattedReservations;
    }
}
