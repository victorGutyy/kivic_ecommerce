@extends('layouts.shop')
@section('content')
<div class="container">
  <h1>Pedidos recientes</h1>
  <table class="table">
    <thead><tr><th>Ref</th><th>Estado</th><th>Total</th><th>Creado</th></tr></thead>
    <tbody>
      @foreach($orders as $o)
        <tr>
          <td>{{ $o->reference }}</td>
          <td>{{ $o->status }}</td>
          <td>{{ $o->total_formatted }}</td>
          <td>{{ $o->created_at }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
