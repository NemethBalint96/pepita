<?php

namespace App\Services\DAL;

use App\Models\Appointment;
use App\Services\Formatter\AppointmentFormatterInterface;

class AppointmentService implements AppointmentServiceInterface
{
    protected $appointmentFormatter;

    public function __construct(AppointmentFormatterInterface $appointmentFormatter)
    {
        $this->appointmentFormatter = $appointmentFormatter;
    }

    public function getAll()
    {
        $appointments = Appointment::all();
        $formattedAppointments = $this->appointmentFormatter->format($appointments);
        return $formattedAppointments;
    }
}
