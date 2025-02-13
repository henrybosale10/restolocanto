<x-guest-layout>
    <section class="contact-form bg-gray-100 py-12">
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-4">Nous Contacter</h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="motif" class="block font-medium">Motif</label>
                    <select name="motif" id="motif" class="w-full border-gray-300 rounded p-2" required>
                        <option value="Demande de renseignements">Demande de renseignements</option>
                        <option value="Réclamation">Réclamation</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div>
                    <label for="message" class="block font-medium">Message</label>
                    <textarea name="message" id="message" rows="4" class="w-full border-gray-300 rounded p-2" required></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Envoyer
                </button>
            </form>
        </div>
    </section>

</x-guest-layout>
