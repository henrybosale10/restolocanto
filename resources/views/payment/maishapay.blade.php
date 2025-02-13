<form action="https://marchand.maishapay.online/payment/vers1.0/merchant/checkout" method="POST">
    <input type="hidden" name="gatewayMode" value="{{ $data['gatewayMode'] }}">
    <input type="hidden" name="publicApiKey" value="{{ $data['publicApiKey'] }}">
    <input type="hidden" name="secretApiKey" value="{{ $data['secretApiKey'] }}">
    <input type="hidden" name="montant" value="{{ $data['montant'] }}">
    <input type="hidden" name="devise" value="{{ $data['devise'] }}">
    <input type="hidden" name="callbackUrl" value="{{ $data['callbackUrl'] }}">
    <button type="submit">Payer avec MaishaPay</button>
  </form>
