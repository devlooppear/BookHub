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
            $reservations = Reservation::with(['user', 'book'])->get();
            return response()->json($reservations);
        } catch (Exception $e) {
            Log::error('Error fetching reservations: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching reservations: ' . $e->getMessage()]);
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
            return response()->json(['error' => 'An error occurred while storing the reservation: ' . $e->getMessage()]);
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
            return response()->json(['error' => 'An error occurred while fetching reservation details: ' . $e->getMessage()]);
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
                'user_id' => 'nullable|exists:users,id|integer',
                'book_id' => 'nullable|exists:books,id|integer',
                'reservation_date' => 'date',
                'pickup_deadline' => 'date',
                'is_active' => 'nullable|numeric|in:0,1',
            ]);

            // Convert user_id and book_id to integers
            $user_id = $request->input('user_id');
            $book_id = $request->input('book_id');

            if (!is_null($user_id)) {
                $request->merge(['user_id' => intval($user_id)]);
            }

            if (!is_null($book_id)) {
                $request->merge(['book_id' => intval($book_id)]);
            }

            // Convert is_active to integer
            $is_active = $request->input('is_active');
            if (!is_null($is_active)) {
                $request->merge(['is_active' => intval($is_active)]);
            }

            // Use fill method instead of update to only update the provided fields
            $reservation->fill($request->all())->save();

            return response()->json($reservation, 200);
        } catch (Exception $e) {
            Log::error('Error updating reservation: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the reservation: ' . $e->getMessage()]);
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
            return response()->json(['error' => 'An error occurred while deleting the reservation: ' . $e->getMessage()]);
        }
    }
}
