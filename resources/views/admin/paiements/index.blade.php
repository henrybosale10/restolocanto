@extends('x-admin-layout')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Liste des Paiements</h1>

    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary mb-4">Ajouter un Paiement</a>

    <table class="table-auto w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Méthode</th>
                <th class="border px-4 py-2">Montant</th>
                <th class="border px-4 py-2">Commande</th>
                <th class="border px-4 py-2">Statut</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td class="border px-4 py-2">{{ $payment->id }}</td>
                    <td class="border px-4 py-2">{{ $payment->method }}</td>
                    <td class="border px-4 py-2">{{ $payment->amount }} $</td>
                    <td class="border px-4 py-2">Commande #{{ $payment->order_id }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded @if($payment->status == 'completed') bg-green-500 text-white @elseif($payment->status == 'pending') bg-yellow-500 text-white @else bg-red-500 text-white @endif">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">Aucun paiement trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $payments->links() }}
</div>
@endsection
