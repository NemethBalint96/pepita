<?php

namespace App\Services\DAL;

use App\Models\Reservation;
use App\Services\Formatter\ReservationFormatterInterface;

class ReservationService implements ReservationServiceInterface
{
    protected $reservationFormatter;

    public function __construct(ReservationFormatterInterface $reservationFormatter)
    {
        // Constructor to inject the reservation formatter dependency.
        $this->reservationFormatter = $reservationFormatter;
    }

    /**
     * Get all reservations and format them.
     *
     * @return array
     */
    public function getAll(): array
    {
        // Retrieve all reservations from the database.
        $reservations = Reservation::all();

        // Format the reservations using the injected formatter.
        $formattedReservations = $this->reservationFormatter->format($reservations);

        return $formattedReservations;
    }
}
