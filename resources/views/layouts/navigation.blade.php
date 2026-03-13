<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-blue-100 bg-white/95 backdrop-blur dark:bg-slate-900/95 dark:border-slate-700 shadow-sm">
    @php
        $activeService = session('active_service_id')
            ? \App\Models\Service::find(session('active_service_id'))
            : null;
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-sky-500 text-white shadow-md shadow-blue-200">
                            <x-application-logo class="block h-6 w-6 fill-current text-white" />
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-semibold tracking-wide text-slate-900 dark:text-white">
                                BrightNest
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                Childcare Admin
                            </p>
                        </div>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-10 gap-2">
                    @if($activeService)
                        <x-nav-link :href="route('app.dashboard')" :active="request()->routeIs('app.dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.*')">
                            Rooms
                        </x-nav-link>

                        <x-nav-link :href="route('children.index')" :active="request()->routeIs('children.*')">
                            Children
                        </x-nav-link>

                        <x-nav-link :href="route('enrolments.index')" :active="request()->routeIs('enrolments.*')">
                            Enrolments
                        </x-nav-link>

                        <x-nav-link :href="route('staff.index')" :active="request()->routeIs('staff.*')">
                            Staff
                        </x-nav-link>

                        <x-nav-link :href="route('attendances.index')" :active="request()->routeIs('attendances.*')">
                            Attendance
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @if($activeService)
                    <div class="rounded-2xl border border-blue-100 bg-blue-50 px-4 py-2 shadow-sm">
                        <div class="text-[11px] uppercase tracking-wide text-blue-600 font-semibold">
                            Active Service
                        </div>
                        <div class="text-sm font-semibold text-slate-800">
                            {{ $activeService->service_name }}
                        </div>
                    </div>

                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center rounded-xl border border-blue-200 bg-white px-4 py-2 text-sm font-medium text-blue-700 shadow-sm transition hover:bg-blue-50 hover:border-blue-300">
                        Switch
                    </a>
                @endif

                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-sky-400 text-white font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                                <div class="text-left">
                                    <div class="text-sm font-semibold leading-tight">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-slate-500 leading-tight">{{ Auth::user()->email }}</div>
                                </div>

                                <svg class="h-4 w-4 fill-current text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-slate-700 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out"
                                >
                                    Log Out
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2 text-slate-500 shadow-sm hover:bg-blue-50 hover:text-blue-700 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-blue-100 bg-white">
        <div class="pt-3 pb-3 space-y-1 px-3">
            @if($activeService)
                <x-responsive-nav-link :href="route('app.dashboard')" :active="request()->routeIs('app.dashboard')">
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.*')">
                    Rooms
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('children.index')" :active="request()->routeIs('children.*')">
                    Children
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('enrolments.index')" :active="request()->routeIs('enrolments.*')">
                    Enrolments
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('staff.index')" :active="request()->routeIs('staff.*')">
                    Staff
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('attendances.index')" :active="request()->routeIs('attendances.*')">
                    Attendance
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-responsive-nav-link>
            @endif
        </div>

        @if($activeService)
            <div class="mx-4 mb-3 rounded-2xl border border-blue-100 bg-blue-50 px-4 py-3">
                <div class="text-[11px] uppercase tracking-wide text-blue-600 font-semibold">
                    Active Service
                </div>
                <div class="text-sm font-semibold text-slate-800">
                    {{ $activeService->service_name }}
                </div>

                <div class="mt-2">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-blue-700 hover:underline">
                        Switch Service
                    </a>
                </div>
            </div>
        @endif

        <div class="pt-4 pb-2 border-t border-slate-200">
            <div class="px-4">
                <div class="font-semibold text-base text-slate-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-3">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="block w-full text-left rounded-xl px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"
                    >
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>