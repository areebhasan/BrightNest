<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceSelectionController extends Controller
{
    public function index(Request $request)
    {
        $services = $request->user()->services()->get();

        return view('services.select', compact('services'));
    }
}