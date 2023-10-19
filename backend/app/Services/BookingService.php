<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Services\Repetition\RepetitionFactory;

class BookingService implements BookingServiceInterface
{
    /**
     * Check if a reservation is bookable.
     *
     * @param Reservation $reservation
     * @return bool
     */
    public function isBookable(Reservation $reservation): bool
    {
        // Parse reservation start and end times as Carbon objects for consistency.
        $reservation->start = Carbon::parse($reservation->start);
        $reservation->end = Carbon::parse($reservation->end);

        // Check if there is an appointment at the given time, and if the time is available.
        return $this->isThereAnAppointment($reservation) && $this->isAvailableTime($reservation);
    }

    /**
     * Check if the reservation time is available and doesn't overlap with existing bookings.
     *
     * @param Reservation $reservation
     * @return bool
     */
    private function isAvailableTime(Reservation $reservation): bool
    {
        // Get all existing bookings.
        $bookings = Reservation::all();

        foreach ($bookings as $booking) {
            $bookingStart = Carbon::parse($booking->start);
            $bookingEnd = Carbon::parse($booking->end);
            if ($bookingStart->lessThan($reservation->end) && $bookingEnd->greaterThan($reservation->start)) {
                // The time is not available due to overlap with an existing booking.
                return false;
            }
        }

        // The time is available and not overlapping with existing bookings.
        return true;
    }

    /**
     * Check if there is an appointment at the same time as the reservation.
     *
     * @param Reservation $reservation
     * @return bool
     */
    private function isThereAnAppointment(Reservation $reservation): bool
    {
        // Get all existing appointments.
        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            // Check if the appointment has a correct time for the reservation.
            if ($this->isCorrectTime($appointment, $reservation)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the appointment time is correct for the reservation.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return bool
     */
    private function isCorrectTime(Appointment $appointment, Reservation $reservation): bool
    {
        // Create a repetition service based on the appointment's repetition type.
        $repetitionService = RepetitionFactory::create($appointment->repetition);

        // Check if the appointment's time is bookable for the reservation.
        if ($repetitionService->isBookableTime($appointment, $reservation)) {
            return true;
        }

        return false;
    }
}
