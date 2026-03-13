<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Child;
use App\Models\Enrolment;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return response()->json([
                'message' => 'No active service selected.'
            ], 400);
        }

        $service = Service::find($serviceId);

        if (!$service) {
            return response()->json([
                'message' => 'Active service not found.'
            ], 404);
        }

        $totalRooms = Room::where('service_id', $serviceId)->count();
        $totalChildren = Child::where('service_id', $serviceId)->count();
        $activeEnrolments = Enrolment::where('service_id', $serviceId)
            ->where('status', 'active')
            ->count();
        $todayAttendance = Attendance::where('service_id', $serviceId)
            ->whereDate('attendance_date', now()->toDateString())
            ->count();

        return response()->json([
            'service' => [
                'id' => $service->id,
                'service_name' => $service->service_name,
                'provider_name' => $service->provider_name,
                'daily_fee' => $service->daily_fee,
            ],
            'stats' => [
                'total_rooms' => $totalRooms,
                'total_children' => $totalChildren,
                'active_enrolments' => $activeEnrolments,
                'today_attendance' => $todayAttendance,
            ],
        ]);
    }
}