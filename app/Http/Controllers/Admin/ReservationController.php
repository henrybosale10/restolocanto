<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatutTable; // Enum traduit
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Constructeur du contrôleur : middleware pour l'accès admin.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Afficher la liste des réservations.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Récupération des critères de filtre depuis la requête
        $prenom = $request->get('prenom');
        $nom = $request->get('nom');
        $date_reservation = $request->get('date_reservation');

        // Construction de la requête de base
        $query = Reservation::query();

        // Application des filtres
        if ($prenom) {
            $query->where('prenom', 'like', "%$prenom%");
        }
        if ($nom) {
            $query->where('nom', 'like', "%$nom%");
        }
        if ($date_reservation) {
            $query->whereDate('date_reservation', $date_reservation);
        }

        // Pagination des résultats
        $reservations = $query->paginate(5);

        // Redirection après modification des critères de filtrage
        $returnTo = $request->get('return_to', route('admin.reservations.index'));

        return view('admin.reservations.index', compact('reservations', 'returnTo'));
    }


    /**
     * Afficher le formulaire de création d'une nouvelle réservation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Récupérer uniquement les tables disponibles
        $tables = Table::where('status', StatutTable::Disponible->value)->get();

        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Enregistrer une nouvelle réservation.
     *
     * @param  \App\Http\Requests\ReservationStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReservationStoreRequest $request)
    {
        Reservation::create($request->validated());

        $returnTo = $request->get('return_to', route('admin.reservations.index'));

        return redirect()->to($returnTo)->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Afficher le formulaire d'édition d'une réservation.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $tables = Table::where('status', StatutTable::Disponible->value)->get();

        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Mettre à jour une réservation existante.
     *
     * @param  \App\Http\Requests\ReservationStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReservationStoreRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->validated());

        $returnTo = $request->get('return_to', route('admin.reservations.index'));

        return redirect()->to($returnTo)->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Supprimer une réservation.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();

        $returnTo = $request->input('return_to', route('admin.reservations.index'));

        return redirect($returnTo)->with('success', 'Réservation supprimée avec succès.');
    }
}
