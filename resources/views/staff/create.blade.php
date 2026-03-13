<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Staff
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('staff.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">First Name</label>
                        <input type="text" name="first_name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Last Name</label>
                        <input type="text" name="last_name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Role</label>
                        <input type="text" name="role" class="w-full border rounded px-3 py-2" placeholder="Educator / Room Leader" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Room</label>
                        <select name="room_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select Room</option>

                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">
                                    {{ $room->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save Staff
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>