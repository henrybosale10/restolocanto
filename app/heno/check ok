<x-guest-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h2 class="text-2xl font-bold text-center mb-8">Choisissez votre mode de paiement</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- MaishaPay -->
            <form action="https://marchand.maishapay.online/payment/vers1.0/merchant/checkout" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="gatewayMode" value="0">
                <input type="hidden" name="publicApiKey" value="{{ env('MAISHAPAY_PUBLIC_KEY') }}">
                <input type="hidden" name="secretApiKey" value="{{ env('MAISHAPAY_SECRET_KEY') }}">
                <input type="hidden" name="montant" value="{{ $order->total_price }}">
                <input type="hidden" name="devise" value="CDF">
                <input type="hidden" name="callbackUrl" value="{{ route('payment.callback') }}">
                <input type="hidden" name="paymentMethod" value="mobilemoney">
                <input type="hidden" name="client_name" value="{{ $order->user->name }}">
                <input type="hidden" name="client_email" value="{{ $order->user->email }}">
                <input type="hidden" name="client_address" value="{{ $order->livraison->adresse }}">

                <button type="submit" class="w-full flex flex-col items-center justify-center group bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <div class="relative">
                        <img src="/logo/mai.jpg" alt="MaishaPay" class="w-24 h-24 mb-4 transition-opacity duration-300 group-hover:opacity-50">
                        <p class="text-lg font-semibold absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">MaishaPay</p>
                    </div>
                </button>
            </form>

            <!-- MaxiCash -->
            <form action="https://api-testbed.maxicashapp.com/payentry" method="POST" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                @csrf
                <input type="hidden" name="amount" value="{{ $order->total_price }}">
                <input type="hidden" name="currency" value="CDF">
                <button type="submit" class="w-full flex flex-col items-center justify-center group">
                    <div class="relative">
                        <img src="/logo/MaxicashLogo.png" alt="MaxiCash" class="w-26 h-24 mb-4 transition-opacity duration-300 group-hover:opacity-50">
                        <p class="text-lg font-semibold absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">MaxiCash</p>
                    </div>
                </button>
            </form>

            <!-- Orange Money -->
            <form action="https://orangemoney.com/payment" method="POST" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                @csrf
                <input type="hidden" name="amount" value="{{ $order->total_price }}">
                <button type="submit" class="w-full flex flex-col items-center justify-center group">
                    <div class="relative">
                        <img src="/logo/Orange-Money.png" alt="Orange Money" class="w-24 h-24 mb-4 transition-opacity duration-300 group-hover:opacity-50">
                        <p class="text-lg font-semibold absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">Orange Money</p>
                    </div>
                </button>
            </form>

            <!-- PayPal -->
            <form action="https://www.paypal.com/checkout" method="POST" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                @csrf
                <input type="hidden" name="amount" value="{{ $order->total_price }}">
                <button type="submit" class="w-full flex flex-col items-center justify-center group">
                    <div class="relative">
                        <img src="/logo/paypal.jpg" alt="PayPal" class="w-24 h-24 mb-4 transition-opacity duration-300 group-hover:opacity-50">
                        <p class="text-lg font-semibold absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">PayPal</p>
                    </div>
                </button>
            </form>

            <!-- Airtel Money -->
            <form action="https://airtelmoney.com/payment" method="POST" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                @csrf
                <input type="hidden" name="amount" value="{{ $order->total_price }}">
                <button type="submit" class="w-full flex flex-col items-center justify-center group">
                    <div class="relative">
                        <img src="/logo/airtel.jpg" alt="Airtel Money" class="w-24 h-24 mb-4 transition-opacity duration-300 group-hover:opacity-50">
                        <p class="text-lg font-semibold absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">Airtel Money</p>
                    </div>
                </button>
            </form>

            <!-- M-Pesa -->
            <form action="https://www.paypal-mobilemoney.com/m-pesa" method="POST" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                @csrf
                <input type="hidden" name="amount" value="{{ $order->total_price }}">
                <button type="submit" class="w-full flex flex-col items-center justify-center group">
                    <div class="relative">
                        <img src="/logo/mpesa.jpg" alt="M-Pesa" class="w-26 h-24 mb-4 transition-opacity duration-300 group-hover:opacity-50">
                        <p class="text-lg font-semibold absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">M-Pesa</p>
                    </div>
                </button>
            </form>


        </div>
    </div>
</x-guest-layout>
