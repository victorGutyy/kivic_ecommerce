<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Redirigiendo al pago seguro ePayco…</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://checkout.epayco.co/checkout.js"></script>
  <style>
    body {font-family:system-ui; display:flex; align-items:center; justify-content:center; height:100vh; background:#f9fafb;}
    .card {background:#fff; padding:30px; border-radius:16px; box-shadow:0 10px 25px rgba(0,0,0,.1); text-align:center;}
    .btn {background:#4f46e5; color:#fff; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;}
  </style>
</head>
<body>
  <div class="card">
    <h2>Redirigiendo a ePayco...</h2>
    <p>Por favor espera un momento.</p>
    <button id="payBtn" class="btn">Pagar ahora</button>
  </div>

  <script>
    const handler = ePayco.checkout.configure({
      key: "{{ $epayco['public_key'] }}",
      test: {{ $epayco['test'] }},
    });

    document.getElementById('payBtn').addEventListener('click', function(){
      handler.open({
        external: true,
        amount: "{{ $epayco['amount'] }}",
        name: "{{ $epayco['description'] }}",
        description: "{{ $epayco['description'] }}",
        currency: "{{ $epayco['currency'] }}",
        country: "CO",
        lang: "es",
        invoice: "{{ $epayco['reference'] }}",
        response: "{{ $epayco['response'] }}",
        confirmation: "{{ $epayco['confirmation'] }}",
        email_billing: "{{ $epayco['email_billing'] }}",
        name_billing: "{{ $epayco['name_billing'] }}",
        type_doc_billing: "CC",
        number_doc_billing: "123456789",
        method_confirmation: "POST",
      });
    });

    // auto-click para flujo automático
    window.addEventListener('load', () => {
      document.getElementById('payBtn').click();
    });
  </script>
</body>
</html>
