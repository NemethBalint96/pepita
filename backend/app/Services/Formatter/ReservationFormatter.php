<?php

namespace App\Services\Formatter;

class ReservationFormatter implements ReservationFormatterInterface
{
    /**
     * Format a collection of reservations.
     *
     * @param mixed $reservations
     * @return array
     */
    public function format($reservations): array
    {
        $formattedReservations = [];

        foreach ($reservations as $reservation) {
            $formattedReservation = [];

            $formattedReservation['title'] = $reservation->title;
            $formattedReservation['start'] = $reservation->start;
            $formattedReservation['end'] = $reservation->end;

            $formattedReservations[] = $formattedReservation;
        }

        return $formattedReservations;
    }
}
