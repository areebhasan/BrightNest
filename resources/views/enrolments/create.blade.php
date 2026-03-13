<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Enrolment
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('enrolments.store') }}" class="space-y-4">
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
                        <label class="block text-sm font-medium">Start Date</label>
                        <input type="date" name="start_date" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">End Date</label>
                        <input type="date" name="end_date" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save Enrolment
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>