<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\StatutTable;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Enums\TableStatus;
use App\Notifications\ReservationConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\ReservationConfirmedNotification;

class ReservezController extends Controller
{
    /**
     * Afficher le formulaire de réservation.
     */
    public function create()
    {
        // Définir la date minimale et maximale pour la réservation
        $min_date = Carbon::today()->toDateString();
        $max_date = Carbon::now()->addWeek()->toDateString();

        // Récupérer les tables disponibles
        $tables = Table::where('status', StatutTable::Disponible)->get();

        // Retourner la vue avec les données nécessaires
        return view('reservation.create', compact('min_date', 'max_date', 'tables'));
    }

    /**
     * Enregistrer la réservation et rediriger vers la page de remerciement.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'date_reservation' => 'required|date',
            'guest_number' => 'required|integer|min:1',
            'table_id' => 'required|exists:tables,id',
            'telephone' => 'required|string|max:15',
        ]);

        try {
            // Sauvegarder la réservation dans la base de données
            $reservation = Reservation::create([
                'prenom' => $validated['prenom'],
                'nom' => $validated['nom'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
                'date_reservation' => $validated['date_reservation'],
                'guest_number' => $validated['guest_number'],
                'table_id' => $validated['table_id'],
                'status' => 'pending',  // Statut initial de la réservation
            ]);

            // Journal pour confirmer la sauvegarde
            Log::info('Réservation créée avec succès', [
                'reservation_id' => $reservation->id,
                'data' => $validated,
            ]);

            // Envoi de la notification
            $this->sendReservationConfirmationNotification($reservation);

            // Redirection vers la page de remerciement
            return redirect()->route('thankyou')->with('success', 'Votre réservation a été enregistrée avec succès !');

        } catch (\Exception $e) {
            // Journal des erreurs
            Log::error('Erreur lors de la sauvegarde de la réservation', [
                'message' => $e->getMessage(),
                'data' => $request->all(),
            ]);

            // Retourner en arrière avec un message d'erreur
            return back()->withErrors('Une erreur est survenue lors de la sauvegarde. Veuillez réessayer.');
        }
    }

    /**
     * Fonction pour envoyer la notification de confirmation de réservation.
     */
    private function sendReservationConfirmationNotification($reservation)
    {
        $user = Auth::user();
        $user->notify(new ReservationConfirmed($reservation));
    }
}
