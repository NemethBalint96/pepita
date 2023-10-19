<?php

namespace App\Services\Repetition;

use App\Common\DateTimeFormat;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Appointment;
use App\Models\Reservation;

class Weekly extends NoRepetition
{
    /**
     * Check if a reservation is bookable within a weekly repeating appointment.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return bool
     */
    public function isBookableTime(Appointment $appointment, Reservation $reservation): bool
    {
        if (parent::isBookableTime($appointment, $reservation)) {
            if ($this->isSameDay($appointment, $reservation)) {
                $appointmentStartTime = $this->getAppointmentStartTime($appointment, $reservation);
                $appointmentEndTime = $this->getAppointmentEndTime($appointment, $appointmentStartTime);
                if ($appointmentStartTime->lessThanOrEqualTo($reservation->start) && $appointmentEndTime->greaterThanOrEqualTo($reservation->end)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if the appointment and reservation are on the same day.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return bool
     */
    private function isSameDay(Appointment $appointment, Reservation $reservation): bool
    {
        return $reservation->start->dayOfWeekIso - 1 === $appointment->day_of_week;
    }

    /**
     * Get the start time of the appointment based on the reservation.
     *
     * @param Appointment $appointment
     * @param Reservation $reservation
     * @return Carbon
     */
    private function getAppointmentStartTime(Appointment $appointment, Reservation $reservation): Carbon
    {
        $appointmentStartTime = Carbon::parse($reservation->start);
        $appointmentStartTime->setTimeFromTimeString(Carbon::parse($appointment->start_time)->toTimeString());
        return $appointmentStartTime;
    }

    /**
     * Get the end time of the appointment based on the start time.
     *
     * @param Appointment $appointment
     * @param Carbon $appointmentStartTime
     * @return Carbon
     */
    private function getAppointmentEndTime(Appointment $appointment, Carbon $appointmentStartTime): Carbon
    {
        $interval = CarbonInterval::createFromFormat(DateTimeFormat::TIME_FORMAT, $appointment->time_within_day);
        $appointmentEndTime = Carbon::parse($appointmentStartTime);
        $appointmentEndTime->add($interval);
        return $appointmentEndTime;
    }
}
