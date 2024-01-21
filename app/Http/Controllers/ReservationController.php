<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     *
     * @return Response
     */
    public function index()
    {
        $reservations = Reservation::all();

        return response()->json($reservations);
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'reservation_date' => 'required|date',
            'pickup_deadline' => 'required|date',
            'is_active' => 'boolean',
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json($reservation, 201);
    }

    /**
     * Display the specified reservation.
     *
     * @param  Reservation  $reservation
     * @return Response
     */
    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
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
        $request->validate([
            'user_id' => 'exists:users,id',
            'book_id' => 'exists:books,id',
            'reservation_date' => 'date',
            'pickup_deadline' => 'date',
            'is_active' => 'boolean',
        ]);

        $reservation->update($request->all());

        return response()->json($reservation, 200);
    }

    /**
     * Remove the specified reservation from storage.
     *
     * @param  Reservation  $reservation
     * @return Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json(null, 204);
    }
}
