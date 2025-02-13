@extends('x-admin-layout')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Ajouter un Paiement</h1>

    <form action="{{ route('admin.payments.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="method" class="block text-sm font-medium text-gray-700">Méthode de paiement</label>
            <select name="method" id="method" class="form-control">
                <option value="Orange Money">Orange Money</option>
                <option value="M-Pesa">M-Pesa</option>
                <option value="Airtel Money">Airtel Money</option>
                <option value="Afrimoney">Afrimoney</option>
                <option value="MaxiCash">MaxiCash</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="transaction_id" class="block text-sm font-medium text-gray-700">ID de Transaction (Optionnel)</label>
            <input type="text" name="transaction_id" id="transaction_id" class="form-control">
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Montant</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
        </div>

        <div class="mb-4">
            <label for="order_id" class="block text-sm font-medium text-gray-700">Commande</label>
            <select name="order_id" id="order_id" class="form-control">
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">Commande #{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="status" id="status" class="form-control">
                <option value="pending">En attente</option>
                <option value="completed">Terminé</option>
                <option value="failed">Échoué</option>
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
