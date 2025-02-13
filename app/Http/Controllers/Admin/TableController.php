<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TableController extends Controller
{
    /**
     * Affiche la liste des tables.
     */
    public function index(Request $request)
    {
        // Filtre par statut (si fourni) et pagination
        $status = $request->input('status');
        $tables = Table::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->paginate(5); // 10 éléments par page

        // Retourne la vue avec les données des tables
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Affiche le formulaire pour créer une nouvelle table.
     */
    public function create()
    {
        return view('admin.tables.create'); // Vue du formulaire de création
    }

    /**
     * Enregistre une nouvelle table dans la base de données.
     */
    public function store(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'guest_number' => 'required|integer',
        'status' => 'required|string',
        'location' => 'required|string|max:255',  // Assurez-vous que location est requis
        'image' => 'nullable|image|max:2048',
    ]);

    // Création de la nouvelle table
    $table = Table::create([
        'name' => $request->name,
        'guest_number' => $request->guest_number,
        'status' => $request->status,
        'location' => $request->location,
        'image' => $request->file('image') ? $request->file('image')->store('tables') : null,
    ]);

    // Redirection vers la liste des tables avec un message de succès
    return to_route('admin.tables.index')->with('success', 'Table créée avec succès !');
}


    /**
     * Affiche le formulaire pour modifier une table existante.
     */
    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table')); // Vue d'édition
    }

    /**
     * Met à jour une table existante dans la base de données.
     */
    public function update(Request $request, Table $table)
    {
        $table->update([
            'name' => $request->name,
            'guest_number' => $request->guest_number,
            'status' => $request->status,
            'location' => $request->location,
            'image' => $request->file('image') ? $request->file('image')->store('tables') : $table->image,
        ]);

        return to_route('admin.tables.index')->with('success', 'Table modifiée avec succès !');
    }

    /**
     * Supprime une table de la base de données.
     */
    public function destroy(Table $table)
    {
        if ($table->reservations()->exists()) {
            return to_route('admin.tables.index')->with('error', 'Impossible de supprimer : des réservations sont encore associées à cette table.');
        }

        if ($table->image) {
            Storage::delete($table->image); // Suppression de l'image associée
        }

        $table->delete();
        return to_route('admin.tables.index')->with('success', 'Table supprimée avec succès !');
    }
}
