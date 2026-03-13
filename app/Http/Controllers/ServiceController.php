<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => ['required', 'string', 'max:255'],
            'service_code' => ['nullable', 'string', 'max:100'],
            'provider_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address_line_1' => ['nullable', 'string', 'max:255'],
            'suburb' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'postcode' => ['nullable', 'string', 'max:20'],
            'daily_fee' => ['required', 'numeric', 'min:0'],
            'opening_time' => ['nullable'],
            'closing_time' => ['nullable'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        $service = Service::create([
            'service_name' => $validated['service_name'],
            'service_code' => $validated['service_code'] ?? null,
            'provider_name' => $validated['provider_name'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address_line_1' => $validated['address_line_1'] ?? null,
            'suburb' => $validated['suburb'] ?? null,
            'state' => $validated['state'] ?? null,
            'postcode' => $validated['postcode'] ?? null,
            'daily_fee' => $validated['daily_fee'],
            'opening_time' => $validated['opening_time'] ?? null,
            'closing_time' => $validated['closing_time'] ?? null,
            'capacity' => $validated['capacity'] ?? null,
            'status' => $validated['status'] ?? 'active',
        ]);

        $request->user()->services()->attach($service->id, [
            'access_role' => 'owner',
            'status' => 'active',
        ]);

        return redirect()->route('dashboard')->with('success', 'Service created successfully.');
    }
}