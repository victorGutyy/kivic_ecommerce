@php
    use Illuminate\Support\Str;

    /** @var \App\Models\Product $p */

    // 1) Obtenemos la primera imagen
    $firstImage = $p->images->first();

    // Intentamos primero con 'url', luego con 'src' (por compatibilidad)
    $raw = $firstImage->url ?? $firstImage->src ?? null;

    // 2) Resolvemos la URL final de la imagen
    if (!$raw) {
        // Sin imagen → placeholder genérico
        $img = asset('assets/demo/placeholder.png');
    } else {
        if (Str::startsWith($raw, ['http://', 'https://', '/'])) {
            // Ya viene como URL absoluta
            $img = $raw;
        } elseif (Str::startsWith($raw, 'assets/')) {
            // Imágenes de demo en public/assets/...
            $img = asset($raw);
        } else {
            // Imágenes subidas por el usuario: storage/app/public/...
            // En BD guardamos: products/archivo.jpg
            $img = asset('storage/'.$raw);
        }
    }

    // 3) Formateo de precio
    // Si guardas en pesos "normales" (35000):
    $price = '$ '.number_format((int)$p->price, 0, ',', '.');

    // Si estuvieras guardando en centavos, sería:
    // $price = '$ '.number_format((int)($p->price / 100), 0, ',', '.');

    // 4) URL de detalle del producto
    $show = route('shop.show', ['store' => $store->slug, 'product' => $p->id]);
@endphp

<article class="product">
    <a href="{{ $show }}" class="product__cover" aria-label="Ver {{ $p->title }}">
        @if($p->created_at->gt(now()->subDays(7)))
            <span class="badge--new">Nuevo</span>
        @endif

        <img src="{{ $img }}"
             alt="{{ $p->title }}"
             class="product__img"
             loading="lazy">
    </a>

    <div class="product__body">
        <h3 class="product__title">
            <a href="{{ $show }}">{{ $p->title }}</a>
        </h3>

        <div class="product__price">{{ $price }}</div>

        <form action="{{ route('cart.add', $p) }}"
              method="POST"
              class="product__actions">
            @csrf
            <input type="hidden" name="qty" value="1">
            <button type="submit" class="btn btn-primary btn-full">
                Agregar
            </button>
        </form>
    </div>
</article>
