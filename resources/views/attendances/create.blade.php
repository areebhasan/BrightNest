<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Attendance
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('attendances.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Child</label>
                        <select name="child_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">Select Child</option>
                            @foreach($children as $child)
                                <option value="{{ $child->id }}">
                                    {{ $child->first_name }} {{ $child->last_name }} ({{ $child->crn }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Room</label>
                        <select name="room_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">Select Room</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Attendance Date</label>
                        <input type="date" name="attendance_date" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Check In</label>
                            <input type="time" name="check_in" class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Check Out</label>
                            <input type="time" name="check_out" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="late">Late</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Marked By Staff</label>
                        <select name="marked_by_staff_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select Staff</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}">
                                    {{ $member->first_name }} {{ $member->last_name }} - {{ $member->role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save Attendance
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>