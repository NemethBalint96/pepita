<?php

namespace App\Services\DAL;

use App\Models\Appointment;
use App\Services\Formatter\AppointmentFormatterInterface;

class AppointmentService implements AppointmentServiceInterface
{
    protected $appointmentFormatter;

    public function __construct(AppointmentFormatterInterface $appointmentFormatter)
    {
        // Constructor to inject the appointment formatter dependency.
        $this->appointmentFormatter = $appointmentFormatter;
    }

    /**
     * Get all appointments and format them.
     *
     * @return array
     */
    public function getAll(): array
    {
        // Retrieve all appointments from the database.
        $appointments = Appointment::all();

        // Format the appointments using the injected formatter.
        $formattedAppointments = $this->appointmentFormatter->format($appointments);

        return $formattedAppointments;
    }
}
