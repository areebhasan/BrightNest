<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Room
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('rooms.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Room Name</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Age Group</label>
                        <input type="text" name="age_group" class="w-full border rounded px-3 py-2" placeholder="e.g. 2 to 3 years">
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
                            Save Room
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>