<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class AdminNotifController extends Controller
{
    /**
     * Affiche toutes les notifications.
     */
    public function index()
    {
        // Récupère les notifications en paginant
        $notifications = DatabaseNotification::select('id', 'notifiable_id', 'notifiable_type', 'type', 'data')
            ->latest()
            ->paginate(5);

        // Convertir le champ 'data' en chaîne si c'est un tableau ou un objet
        foreach ($notifications as $notification) {
            if (is_array($notification->data) || is_object($notification->data)) {
                $notification->data = json_encode($notification->data);
            }

            // Récupérer l'utilisateur associé à la notification
            $user = $notification->notifiable; // Relation polymorphique
            $notification->user_name = $user ? $user->name : 'Utilisateur non trouvé';
        }

        // Retourne la vue avec les notifications
        return view('admin.notifications.index', compact('notifications'));
    }




    /**
     * Supprime une notification.
     */
    public function destroy($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->delete();

        return redirect()->route('admin.notifications.index')->with('success', 'Notification supprimée avec succès.');
    }

    /**
     * Marque toutes les notifications comme lues.
     */
    public function markAllAsRead()
    {
        DatabaseNotification::whereNull('read_at')->update(['read_at' => now()]);

        return redirect()->route('admin.notifications.index')->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
    public function show($id)
{
    $notification = DatabaseNotification::findOrFail($id);
    // Vérifiez si 'data' est un tableau ou un objet et le convertir en chaîne JSON
    if (is_array($notification->data) || is_object($notification->data)) {
        $notification->data = json_encode($notification->data, JSON_PRETTY_PRINT);
    }

    return view('admin.notifications.show', compact('notification'));
}
}
