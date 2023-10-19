<?php

namespace App\Services\DAL;

class EventService implements EventServiceInterface
{
    protected $appointmentService;
    protected $reservationService;

    public function __construct(
        AppointmentServiceInterface $appointmentService,
        ReservationServiceInterface $reservationService
    )
    {
        // Constructor to inject appointment and reservation services.
        $this->appointmentService = $appointmentService;
        $this->reservationService = $reservationService;
    }

    /**
     * Get all events by combining appointments and reservations.
     *
     * @return array
     */
    public function getAll(): array
    {
        // Retrieve all appointments.
        $appointments = $this->appointmentService->getAll();

        // Retrieve all reservations.
        $reservations = $this->reservationService->getAll();

        // Combine appointments and reservations into a single array of events.
        $events = array_merge($appointments, $reservations);

        return $events;
    }
}
