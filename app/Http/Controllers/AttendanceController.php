<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Child;
use App\Models\Room;
use App\Models\Staff;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $attendances = Attendance::with(['child', 'room', 'markedByStaff'])
            ->where('service_id', $serviceId)
            ->orderBy('attendance_date', 'desc')
            ->get();

        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $children = Child::where('service_id', $serviceId)->orderBy('first_name')->get();
        $rooms = Room::where('service_id', $serviceId)->orderBy('name')->get();
        $staff = Staff::where('service_id', $serviceId)->orderBy('first_name')->get();

        return view('attendances.create', compact('children', 'rooms', 'staff'));
    }

    public function store(Request $request)
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'child_id' => ['required', 'exists:children,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'attendance_date' => ['required', 'date'],
            'check_in' => ['nullable'],
            'check_out' => ['nullable'],
            'status' => ['required', 'string', 'max:50'],
            'marked_by_staff_id' => ['nullable', 'exists:staff,id'],
        ]);

        Attendance::create([
            'service_id' => $serviceId,
            'child_id' => $validated['child_id'],
            'room_id' => $validated['room_id'],
            'attendance_date' => $validated['attendance_date'],
            'check_in' => $validated['check_in'] ?? null,
            'check_out' => $validated['check_out'] ?? null,
            'status' => $validated['status'],
            'marked_by_staff_id' => $validated['marked_by_staff_id'] ?? null,
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance created successfully.');
    }
}