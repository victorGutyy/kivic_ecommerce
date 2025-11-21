<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreOnboardingController extends Controller
{
    // Paso 1: datos básicos
    public function step1(Request $request)
    {
        $data = $request->session()->get('onboarding.store', []);

        return view('onboarding.store-step1', compact('data'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required','string','max:100'],
            'country' => ['required','string','size:2'], // CO
            'currency'=> ['required','string','max:5'],  // COP
        ]);

        $session = $request->session()->get('onboarding.store', []);
        $request->session()->put('onboarding.store', array_merge($session, $validated));

        return redirect()->route('stores.create.step2');
    }

    // Paso 2: info de negocio / contacto
    public function step2(Request $request)
    {
        $data = $request->session()->get('onboarding.store', []);

        // si alguien intenta saltarse el paso 1
        if (empty($data['name'] ?? null)) {
            return redirect()->route('stores.create.step1');
        }

        return view('onboarding.store-step2', compact('data'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => ['nullable','string','max:150'],
            'industry'   => ['nullable','string','max:100'],
            'phone'      => ['nullable','string','max:30'],
            'whatsapp'   => ['nullable','string','max:30'],
            'instagram'  => ['nullable','string','max:100'],
            'city'       => ['nullable','string','max:100'],
        ]);

        $session = $request->session()->get('onboarding.store', []);
        $request->session()->put('onboarding.store', array_merge($session, $validated));

        return redirect()->route('stores.create.step3');
    }

    // Paso 3: selección de plan + plantilla (theme)
    public function step3(Request $request)
    {
        $data = $request->session()->get('onboarding.store', []);

        if (empty($data['name'] ?? null)) {
            return redirect()->route('stores.create.step1');
        }

        // Por ahora dejamos 3 temas; luego los diseñamos
        $themes = [
            'kivic-classic'   => 'KIVIC Classic',
            'kivic-minimal'   => 'KIVIC Minimal',
            'kivic-dark'      => 'KIVIC Dark',
        ];

        return view('onboarding.store-step3', compact('data','themes'));
    }

    public function finish(Request $request)
    {
        $validated = $request->validate([
            'plan'  => ['required','in:free,starter,pro'],
            'theme' => ['required','in:kivic-classic,kivic-minimal,kivic-dark'],
        ]);

        $data = $request->session()->get('onboarding.store', []);

        if (empty($data['name'] ?? null)) {
            return redirect()->route('stores.create.step1');
        }

        // Mezclar todo
        $data = array_merge($data, $validated);

        // Generar slug único
        $base = Str::slug($data['name']);
        $slug = $base;
        $i    = 1;
        while (Store::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        $store = Store::create([
            'owner_id'  => auth()->id(),
            'name'      => $data['name'],
            'slug'      => $slug,
            'country'   => $data['country'] ?? 'CO',
            'currency'  => $data['currency'] ?? 'COP',
            'brand_name'=> $data['brand_name'] ?? null,
            'industry'  => $data['industry'] ?? null,
            'phone'     => $data['phone'] ?? null,
            'whatsapp'  => $data['whatsapp'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'city'      => $data['city'] ?? null,
            'plan'      => $data['plan'],
            'theme'     => $data['theme'],
        ]);

        // Limpiar datos de sesión del wizard
        $request->session()->forget('onboarding.store');

        // (Opcional) sembrar productos demo básicos de una vez
        // DemoCatalogService::seedForStore($store);

        return redirect()
            ->route('dashboard')
    ->with('status', 'Tu tienda '.$store->name.' ha sido creada 🎉');
    }
}
