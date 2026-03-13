<?php

namespace App\Http\Controllers;

use App\Models\Enrolment;
use App\Models\Child;
use App\Models\Room;
use Illuminate\Http\Request;

class EnrolmentController extends Controller
{
    public function index()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $enrolments = Enrolment::with(['child','room'])
            ->where('service_id', $serviceId)
            ->orderBy('start_date','desc')
            ->get();

        return view('enrolments.index', compact('enrolments'));
    }

    public function create()
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $children = Child::where('service_id', $serviceId)->orderBy('first_name')->get();
        $rooms = Room::where('service_id', $serviceId)->orderBy('name')->get();

        return view('enrolments.create', compact('children','rooms'));
    }

    public function store(Request $request)
    {
        $serviceId = session('active_service_id');

        $validated = $request->validate([
            'child_id' => ['required','exists:children,id'],
            'room_id' => ['required','exists:rooms,id'],
            'start_date' => ['required','date'],
            'end_date' => ['nullable','date'],
            'status' => ['required','string']
        ]);

        Enrolment::create([
            'service_id' => $serviceId,
            'child_id' => $validated['child_id'],
            'room_id' => $validated['room_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status']
        ]);

        return redirect()->route('enrolments.index')
            ->with('success','Enrolment created successfully.');
    }
}