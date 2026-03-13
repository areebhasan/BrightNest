<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Select a Service
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-4">
                    <a href="{{ route('services.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">
                        Create New Service
                    </a>
                </div>

                @if($services->isEmpty())
                    <p class="text-gray-600">
                        No services are linked to your account yet.
                    </p>
                @else

                    <div class="space-y-4">
                        @foreach($services as $service)

                            <div class="border rounded-lg p-4 flex items-center justify-between">

                                <div>
                                    <h3 class="text-lg font-semibold">
                                        {{ $service->service_name }}
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        {{ $service->suburb }} {{ $service->state }}
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('services.switch', $service->id) }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                    >
                                        Enter
                                    </button>
                                </form>

                            </div>

                        @endforeach
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>