<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Service
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('services.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Service Name</label>
                        <input type="text" name="service_name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Service Code</label>
                        <input type="text" name="service_code" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Provider Name</label>
                        <input type="text" name="provider_name" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Phone</label>
                        <input type="text" name="phone" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Address</label>
                        <input type="text" name="address_line_1" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Suburb</label>
                            <input type="text" name="suburb" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">State</label>
                            <input type="text" name="state" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Postcode</label>
                            <input type="text" name="postcode" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Daily Fee</label>
                        <input type="number" step="0.01" name="daily_fee" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Opening Time</label>
                            <input type="time" name="opening_time" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Closing Time</label>
                            <input type="time" name="closing_time" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Capacity</label>
                            <input type="number" name="capacity" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Create Service
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>