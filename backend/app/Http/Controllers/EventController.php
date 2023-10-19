<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Services\BookingServiceInterface;
use App\Services\DAL\EventServiceInterface;

class EventController extends Controller
{
    protected $eventService;
    protected $bookingService;

    public function __construct(EventServiceInterface $eventService, BookingServiceInterface $bookingService)
    {
        $this->eventService = $eventService;
        $this->bookingService = $bookingService;
    }

    public function index(): JsonResponse
    {
        $events = $this->eventService->getAll(); 

        return response()->json($events, Response::HTTP_OK);
    }

    public function store(ReservationRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        
        $reservation = Reservation::createReservation($validatedData);

        if ($this->bookingService->isBookable($reservation)) {
            $reservation->save();
            return response()->json(['message' => $reservation], Response::HTTP_CREATED);
        }

        return response()->json(['message' => 'Invalid time'], Response::HTTP_BAD_REQUEST);
    }
}
