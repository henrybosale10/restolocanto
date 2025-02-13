<form action="https://marchand.maishapay.online/payment/vers1.0/merchant/checkout" method="POST">
    <input type="hidden" name="gatewayMode" value="{{ config('maishapay.gateway_mode') }}">
    <input type="hidden" name="publicApiKey" value="{{ config('maishapay.public_api_key') }}">
    <input type="hidden" name="secretApiKey" value="{{ config('maishapay.secret_api_key') }}">
    <input type="hidden" name="montant" value="{{ $total_amount }}">
    <input type="hidden" name="devise" value="USD">
    <input type="hidden" name="callbackUrl" value="{{ route('payment.callback') }}">
    <input type="submit" value="Payer avec MaishaPay">
  </form>
