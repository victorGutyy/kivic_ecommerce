@extends('layouts.shop')

@section('content')
<div class="cart-page container">
  <h2>Carrito de compras</h2>

  @if(empty($cart))
    <div class="empty">Tu carrito está vacío.</div>
  @else
    <div class="cart-table">
      @foreach($cart as $id => $item)
        <div class="cart-row">
          <img class="cart-img" src="{{ $item['image'] ?? asset('assets/tienda1.png') }}"
               alt="{{ $item['title'] ?? 'Producto' }}">

          <div class="cart-info">
            <div class="cart-title">{{ $item['title'] ?? 'Producto' }}</div>

            <div class="cart-price-unit">
              {{ '$ ' . number_format((int)($item['price'] ?? 0), 0, ',', '.') }}
            </div>

            {{-- Formulario para actualizar cantidad --}}
            <form method="POST" action="{{ route('cart.update') }}" class="cart-qty">
              @csrf
              <input type="hidden" name="product_id" value="{{ (int)$id }}">
              <input type="number" min="1" name="qty" value="{{ (int)($item['quantity'] ?? 1) }}">
              <button type="submit" class="btn">Actualizar</button>
            </form>
          </div>

          {{-- Totales por línea --}}
          <div class="cart-line-right">
            <div class="cart-line-total">
              {{ '$ ' . number_format((int)$item['price'] * (int)$item['quantity'], 0, ',', '.') }}
            </div>

            <form method="POST" action="{{ route('cart.remove') }}">
              @csrf
              <input type="hidden" name="product_id" value="{{ (int)$id }}">
              <button class="btn btn--danger">Quitar</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <div class="cart-summary">
      <div>Subtotal: <strong>{{ $fmt($subtotal) }}</strong></div>
      <div>IVA (19%): <strong>{{ $fmt($iva) }}</strong></div>
      <div>Envío: <strong>{{ $fmt($shipping) }}</strong></div>
      <div class="cart-total">Total: <strong>{{ $fmt($total) }}</strong></div>

      <div class="cart-actions">
        <form method="POST" action="{{ route('cart.clear') }}">
          @csrf
          <button class="btn btn--light">Vaciar carrito</button>
        </form>

        <form method="POST" action="{{ route('checkout.create') }}">
          @csrf
          <button class="btn btn--primary">Ir a pagar</button>
        </form>
      </div>
    </div>
  @endif
</div>
@endsection
