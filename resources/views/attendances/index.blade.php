<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Attendance
            </h2>

            <a href="{{ route('attendances.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">
                Add Attendance
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($attendances->isEmpty())
                    <p class="text-gray-600">No attendance records added yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach($attendances as $attendance)
                            <div class="border rounded-lg p-4">
                                <h3 class="text-lg font-semibold">
                                    {{ $attendance->child->first_name ?? 'Unknown' }}
                                    {{ $attendance->child->last_name ?? '' }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Room: {{ $attendance->room->name ?? 'Not assigned' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Date: {{ $attendance->attendance_date }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Check In: {{ $attendance->check_in ?? 'N/A' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Check Out: {{ $attendance->check_out ?? 'N/A' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Status: {{ $attendance->status }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Marked By: 
                                    @if($attendance->markedByStaff)
                                        {{ $attendance->markedByStaff->first_name }} {{ $attendance->markedByStaff->last_name }}
                                    @else
                                        Not set
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>