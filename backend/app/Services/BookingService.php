<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Services\Repetition\RepetitionFactory;

class BookingService implements BookingServiceInterface
{
    public function isBookable(Reservation $reservation): bool
    {
        $reservation->start = Carbon::parse($reservation->start);
        $reservation->end = Carbon::parse($reservation->end);

        return $this->isThereAnAppointment($reservation) && $this->isAvailableTime($reservation);
    }

    private function isAvailableTime(Reservation $reservation): bool
    {
        $bookings = Reservation::all();

        foreach ($bookings as $booking) {
            $bookingStart = Carbon::parse($booking->start);
            $bookingEnd = Carbon::parse($booking->end);
            if ($bookingStart->lessThan($reservation->end) && $bookingEnd->greaterThan($reservation->start)) {
                return false;
            }
        }

        return true;
    }

    private function isThereAnAppointment(Reservation $reservation): bool
    {
        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            if ($this->isCorrectTime($appointment, $reservation)) {
                return true;
            }
        }

        return false;
    }

    private function isCorrectTime(Appointment $appointment, Reservation $reservation): bool
    {
        $repetitionService = RepetitionFactory::create($appointment->repetition);

        if ($repetitionService->isBookableTime($appointment, $reservation)) {
            return true;
        }

        return false;
    }
}
