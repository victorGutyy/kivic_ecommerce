@php
use Illuminate\Support\Str;

$logo = $store->logo_path
    ? asset('storage/' . $store->logo_path)
    : asset('assets/Kivic-logo.png'); 
@endphp

<footer class="store-footer">
    
    <div class="store-footer__inner container">

        {{-- Columna 1: Logo y nombre --}}
        <div class="footer_col">
            <img src="{{ $logo }}" alt="{{ $store->name }}" class="footer_logo">

            <h3 class="footer_store_name">
                {{ $store->brand_name ?? $store->name }}
            </h3>

            @if($store->city)
                <p class="footer_city">{{ $store->city }}</p>
            @endif
        </div>

        {{-- Columna 2: Contacto --}}
        <div class="footer_col">
            <h4>Contacto</h4>

            @if($store->phone)
                <p>📞 {{ $store->phone }}</p>
            @endif

            @if($store->whatsapp)
                <p>
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$store->whatsapp) }}" target="_blank">
                        💬 WhatsApp
                    </a>
                </p>
            @endif

            @if($store->instagram)
                <p>
                    <a href="https://instagram.com/{{ Str::replace('@','',$store->instagram) }}" target="_blank">
                        📷 Instagram
                    </a>
                </p>
            @endif

            @if($store->facebook)
            <p>
                    <a href="{{ Str::startsWith($store->facebook, ['http://','https://']) ? $store->facebook : 'https://facebook.com/'.$store->facebook }}" target="_blank">
                        👍 Facebook
                    </a>
                </p>
            @endif

            @if($store->tiktok)
                <p>
                    <a href="{{ Str::startsWith($store->tiktok, ['http://','https://']) ? $store->tiktok : 'https://www.tiktok.com/@'.Str::replace('@','',$store->tiktok) }}" target="_blank">
                        🎵 TikTok
                    </a>
                </p>
            @endif

            @if($store->youtube)
                <p>
                    <a href="{{ Str::startsWith($store->youtube, ['http://','https://']) ? $store->youtube : 'https://youtube.com/'.$store->youtube }}" target="_blank">
                        ▶️ YouTube
                    </a>
                </p>
            @endif

        </div>

        {{-- Columna 3: Sello KIVIC --}}
        <div class="footer_col footer_kivic_brand">
            <img src="{{ asset('assets/Kivic-logo.png') }}" alt="KIVIC" class="kivic_logo_small">
            <p class="kivic_made">
                Hecho en Colombia 🇨🇴  
                <br>
                <small>Creado con KIVIC E-Commerce</small>
            </p>
        </div>

    </div>

</footer>


<style>
.store-footer {
    background: #0f172a;
    color: #f1f5f9;
    padding: 40px 0;
    margin-top: 60px;
    border-top: 2px solid #1e293b;
}

.store-footer__inner {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
}

.footer_col h4 {
    margin-bottom: 10px;
    font-weight: 600;
}

.footer_logo {
    width: 120px;
    margin-bottom: 10px;
    border-radius: 6px;
}

.footer_store_name {
    font-size: 18px;
    font-weight: 600;
}

.footer_city {
    opacity: .7;
}

.footer_col a {
    color: #94a3b8;
    text-decoration: none;
}

.footer_col a:hover {
    color: #f97316;
}

.footer_kivic_brand {
    text-align: right;
}

.kivic_logo_small {
    width: 80px;
    opacity: .9;
}

.kivic_made {
    font-size: 14px;
    opacity: .8;
    margin-top: 5px;
}
</style>
