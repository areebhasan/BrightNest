<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Room;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $staff = Staff::with('room')
            ->where('service_id', $serviceId)
            ->orderBy('first_name')
            ->get();

        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $rooms = Room::where('service_id', $serviceId)
            ->orderBy('name')
            ->get();

        return view('staff.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'role' => ['required','string','max:255'],
            'room_id' => ['nullable','exists:rooms,id'],
            'status' => ['required','string','max:50'],
        ]);

        Staff::create([
            'service_id' => $serviceId,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'role' => $validated['role'],
            'room_id' => $validated['room_id'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('staff.index')
            ->with('success', 'Staff created successfully.');
    }
}