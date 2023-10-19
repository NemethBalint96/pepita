<?php

namespace App\Services\Formatter;

class ReservationFormatter implements ReservationFormatterInterface
{
    public function format($reservations)
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
