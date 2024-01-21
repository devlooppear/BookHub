<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $reservations = Reservation::all();
            return response()->json($reservations);
        } catch (Exception $e) {
            Log::error('Error fetching reservations: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching reservations.'], 500);
        }
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'book_id' => 'required|exists:books,id',
                'reservation_date' => 'required|date',
                'pickup_deadline' => 'required|date',
                'is_active' => 'boolean',
            ]);

            $reservation = Reservation::create($request->all());

            return response()->json($reservation, 201);
        } catch (Exception $e) {
            Log::error('Error storing reservation: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while storing the reservation.'], 500);
        }
    }

    /**
     * Display the specified reservation.
     *
     * @param  Reservation  $reservation
     * @return Response
     */
    public function show(Reservation $reservation)
    {
        try {
            return response()->json($reservation);
        } catch (Exception $e) {
            Log::error('Error fetching reservation details: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching reservation details.'], 500);
        }
    }

    /**
     * Update the specified reservation in storage.
     *
     * @param  Request  $request
     * @param  Reservation  $reservation
     * @return Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        try {
            $request->validate([
                'user_id' => 'exists:users,id',
                'book_id' => 'exists:books,id',
                'reservation_date' => 'date',
                'pickup_deadline' => 'date',
                'is_active' => 'boolean',
            ]);

            $reservation->update($request->all());

            return response()->json($reservation, 200);
        } catch (Exception $e) {
            Log::error('Error updating reservation: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the reservation.'], 500);
        }
    }

    /**
     * Remove the specified reservation from storage.
     *
     * @param  Reservation  $reservation
     * @return Response
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            Log::error('Error deleting reservation: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the reservation.'], 500);
        }
    }
}
