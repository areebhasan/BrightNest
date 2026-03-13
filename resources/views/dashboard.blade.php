<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }} Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-700">
                    Welcome to {{ $service->service_name }}
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Provider: {{ $service->provider_name }}
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Daily Fee: ${{ number_format($service->daily_fee, 2) }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Rooms</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $totalRooms }}</h3>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Children</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $totalChildren }}</h3>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Active Enrolments</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $activeEnrolments }}</h3>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Today's Attendance</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $todayAttendance }}</h3>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Links</h3>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('rooms.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Rooms
                    </a>

                    <a href="{{ route('children.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Children
                    </a>

                    <a href="{{ route('enrolments.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Enrolments
                    </a>

                    <a href="{{ route('staff.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Staff
                    </a>

                    <a href="{{ route('attendances.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Attendance
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>