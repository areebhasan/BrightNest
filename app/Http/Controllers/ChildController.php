<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $children = Child::where('service_id', $serviceId)
            ->orderBy('first_name')
            ->get();

        return view('children.index', compact('children'));
    }

    public function create()
    {
        if (!session('active_service_id')) {
            return redirect()->route('dashboard');
        }

        return view('children.create');
    }

    public function store(Request $request)
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'crn' => ['required', 'string', 'max:50', 'unique:children,crn'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        Child::create([
            'service_id' => $serviceId,
            'crn' => $validated['crn'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'dob' => $validated['dob'],
            'room_name' => null,
            'status' => $validated['status'] ?? 'active',
        ]);

        return redirect()->route('children.index')
            ->with('success', 'Child created successfully.');
    }
}   