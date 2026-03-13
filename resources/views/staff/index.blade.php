<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Staff
            </h2>

            <a href="{{ route('staff.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">
                Add Staff
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($staff->isEmpty())
                    <p class="text-gray-600">No staff added yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach($staff as $member)
                            <div class="border rounded-lg p-4">
                                <h3 class="text-lg font-semibold">
                                    {{ $member->first_name }} {{ $member->last_name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Role: {{ $member->role }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Room:
                                    {{ $member->room->name ?? 'Not assigned' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Status: {{ $member->status }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>