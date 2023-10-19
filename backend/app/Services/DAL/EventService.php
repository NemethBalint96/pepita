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
        $this->appointmentService = $appointmentService;
        $this->reservationService = $reservationService;
    }

    public function getAll(): array
    {
        $appointments = $this->appointmentService->getAll();
        $reservations = $this->reservationService->getAll();
        
        $events = array_merge($appointments, $reservations);
        return $events;
    }
}
