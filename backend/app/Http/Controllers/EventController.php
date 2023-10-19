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
        // Constructor to inject dependencies.
        $this->eventService = $eventService;
        $this->bookingService = $bookingService;
    }

    /**
     * Get a list of all events.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $events = $this->eventService->getAll();

        return response()->json($events, Response::HTTP_OK);
    }

    /**
     * Store a new reservation.
     *
     * @param ReservationRequest $request
     * @return JsonResponse
     */
    public function store(ReservationRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        // Create a new reservation.
        $reservation = Reservation::createReservation($validatedData);

        if ($this->bookingService->isBookable($reservation)) {
            // Save the reservation if it's bookable.
            $reservation->save();
            return response()->json(['message' => $reservation], Response::HTTP_CREATED);
        }

        // Return a response for an invalid time.
        return response()->json(['message' => 'Invalid time'], Response::HTTP_BAD_REQUEST);
    }
}
