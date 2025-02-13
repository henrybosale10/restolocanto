<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // Récupérer les notifications spécifiques par type
        $notifications = Auth::user()->notifications()->whereIn('type', [
            'App\Notifications\OrderConfirmedNotification',
            'App\Notifications\LivraisonConfirmed',
            'App\Notifications\LivraisonEffectuee',
            'App\Notifications\LivraisonSelectionnee',
            'App\Notifications\UserRegisteredNotification',
            'App\Notifications\ReservationConfirmed',
            'App\Notifications\WelcomeNotification'
        ])->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Récupérer la notification par son ID
        $notification = DatabaseNotification::findOrFail($id);

        // Marquer la notification comme lue
        $notification->markAsRead();

        // Rediriger avec un message de succès
        return back()->with('success', 'Notification marquée comme lue.');
    }


    public function destroy($id)
    {
        $user = Auth::user();

        $notification = DatabaseNotification::findOrFail($id);

        if ($notification->notifiable_id !== $user->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer cette notification.');
        }

        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification supprimée avec succès.');
    }
}
