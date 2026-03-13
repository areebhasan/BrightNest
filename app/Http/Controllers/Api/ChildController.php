<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\JsonResponse;

class ChildController extends Controller
{
    public function index(): JsonResponse
    {
        $query = Child::with('enrolments');
    
        if (request()->filled('room_name')) {
            $query->where('room_name', request('room_name'));
        }
    
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }
    
        if (request()->filled('search')) {
            $search = request('search');
    
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('crn', 'like', "%{$search}%");
            });
        }
    
        $children = $query->get();
    
        return response()->json($children);
    }

    public function store(): JsonResponse
    {
        $validated = request()->validate([
            'crn' => ['required', 'string', 'max:50', 'unique:children,crn'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'room_name' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);
    
        $child = Child::create([
            'crn' => $validated['crn'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'dob' => $validated['dob'],
            'room_name' => $validated['room_name'],
            'status' => $validated['status'] ?? 'active',
        ]);
    
        return response()->json($child, 201);
    }
}