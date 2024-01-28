<?php

namespace App\Listeners;

use App\Events\ReservationEvent;
use App\Models\User;
use App\Notifications\ReservationNotification;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ReservationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReservationEvent $event)
    {
        $librarianUsers = User::where('role_id', 2)->get();

        foreach ($librarianUsers as $librarian) {
            try {
                $librarian->notify(new ReservationNotification($event->reservationData, $event->actionType));
            } catch (Exception $notificationException) {
                Log::error('Error sending reservation notification: ' . $notificationException->getMessage());
            }
        }
    }
}
