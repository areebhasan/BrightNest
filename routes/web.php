<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceSelectionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Api\DashboardController;
use App\Models\Attendance;
use App\Models\Child;
use App\Models\Enrolment;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ServiceSelectionController::class, 'index'])->name('dashboard');

    Route::get('/app/dashboard-data', [DashboardController::class, 'index'])
    ->name('app.dashboard.data');

    Route::post('/services/switch/{service}', function (Service $service) {
        session(['active_service_id' => $service->id]);

        return redirect()->route('app.dashboard');
    })->name('services.switch');

    Route::get('/app', function () {
        $serviceId = session('active_service_id');

        if (!$serviceId) {
            return redirect()->route('dashboard');
        }

        $service = Service::find($serviceId);

        if (!$service) {
            return redirect()->route('dashboard');
        }

        $totalRooms = Room::where('service_id', $serviceId)->count();
        $totalChildren = Child::where('service_id', $serviceId)->count();
        $activeEnrolments = Enrolment::where('service_id', $serviceId)
            ->where('status', 'active')
            ->count();
        $todayAttendance = Attendance::where('service_id', $serviceId)
            ->whereDate('attendance_date', now()->toDateString())
            ->count();

        return view('app.dashboard', compact(
            'service',
            'totalRooms',
            'totalChildren',
            'activeEnrolments',
            'todayAttendance'
        ));
    })->name('app.dashboard');

    Route::get('/app/rooms-data', function () {
        $serviceId = session('active_service_id');
    
        if (!$serviceId) {
            return response()->json(['message' => 'No active service selected.'], 400);
        }
    
        $rooms = \App\Models\Room::where('service_id', $serviceId)
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'age_group',
                'min_age_months',
                'max_age_months',
                'status',
            ]);
    
        return response()->json($rooms);
    })->middleware('auth');

    Route::get('/app/children-data', function () {
        $serviceId = session('active_service_id');
    
        if (!$serviceId) {
            return response()->json(['message' => 'No active service selected.'], 400);
        }
    
        $rooms = \App\Models\Room::where('service_id', $serviceId)->get();
    
        $children = \App\Models\Child::with(['enrolments.room'])
            ->where('service_id', $serviceId)
            ->orderBy('first_name')
            ->get()
            ->map(function ($child) use ($rooms) {
                $activeEnrolment = $child->enrolments
                    ->where('status', 'active')
                    ->sortByDesc('start_date')
                    ->first();
    
                $ageInMonths = \Carbon\Carbon::parse($child->dob)->diffInMonths(now());
    
                $suggestedRoom = $rooms->first(function ($room) use ($ageInMonths) {
                    return !is_null($room->min_age_months)
                        && !is_null($room->max_age_months)
                        && $ageInMonths >= $room->min_age_months
                        && $ageInMonths <= $room->max_age_months;
                });
    
                return [
                    'id' => $child->id,
                    'crn' => $child->crn,
                    'first_name' => $child->first_name,
                    'last_name' => $child->last_name,
                    'dob' => $child->dob,
                    'status' => $child->status,
                    'room_name' => $activeEnrolment?->room?->name,
                    'age_in_months' => $ageInMonths,
                    'suggested_room_name' => $suggestedRoom?->name,
                ];
            });
    
        return response()->json($children);
    })->middleware('auth');
    

    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');

    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    Route::get('/children', [ChildController::class, 'index'])->name('children.index');
    Route::get('/children/create', [ChildController::class, 'create'])->name('children.create');
    Route::post('/children', [ChildController::class, 'store'])->name('children.store');
    Route::delete('/children/{child}', [ChildController::class, 'destroy'])
    ->middleware('auth');

    Route::get('/enrolments', [EnrolmentController::class, 'index'])->name('enrolments.index');
    Route::get('/enrolments/create', [EnrolmentController::class, 'create'])->name('enrolments.create');
    Route::post('/enrolments', [EnrolmentController::class, 'store'])->name('enrolments.store');

    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');

    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';