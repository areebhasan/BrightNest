<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $rooms = Room::where('service_id', $serviceId)
            ->orderBy('name')
            ->get();

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        if (!session('active_service_id')) {
            return redirect()->route('dashboard');
        }

        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'No active service selected.'], 400);
            }

            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age_group' => ['nullable', 'string', 'max:255'],
            'min_age_months' => ['nullable', 'integer', 'min:0'],
            'max_age_months' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        $room = Room::create([
            'service_id' => $serviceId,
            'name' => $validated['name'],
            'age_group' => $validated['age_group'] ?? null,
            'min_age_months' => $validated['min_age_months'] ?? null,
            'max_age_months' => $validated['max_age_months'] ?? null,
            'status' => $validated['status'] ?? 'active',
        ]);

        if ($request->expectsJson()) {
            return response()->json($room, 201);
        }

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function destroy(Request $request, Room $room)
    {
        $serviceId = session('active_service_id');

        if (!$serviceId || $room->service_id != $serviceId) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Room not found for active service.'], 404);
            }

            return redirect()->route('rooms.index');
        }

        $room->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Room deleted successfully.']);
        }

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}