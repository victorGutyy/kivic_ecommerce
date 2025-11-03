@extends('layouts.shop')

@section('content')
<section class="container" style="text-align:center; padding:3rem 1rem;">
  <h1>¡Gracias por tu compra! 🎉</h1>
  <p>Tu pedido <strong>#{{ $order }}</strong> fue recibido.</p>
  <a class="btn btn--primary" href="{{ route('shop.index', ['store' => request()->route('store')->slug ?? 'moda-basica']) }}">
    Volver a la tienda
  </a>
</section>
@endsection
