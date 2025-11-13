<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Student Dashboard' }} - {{ config('app.name', 'Examine CBT') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>

<body class="antialiased bg-gradient-to-br from-primary-50 via-white to-secondary-50">

    <div x-data="{
        sidebarOpen: {{ (isset($currentPage) && $currentPage === 'mock-exam') ? 'false' : 'true' }},
        currentPage: '{{ $currentPage ?? 'dashboard' }}',
        userMenuOpen: false,
        notificationOpen: false
    }" class="min-h-screen flex flex-col lg:flex-row">

        <!-- Sidebar (Desktop Only - Fixed) -->
        <aside
            class="hidden lg:flex fixed top-0 left-0 z-40 w-72 h-screen flex-col transition-transform duration-300 ease-in-out bg-white/95 backdrop-blur-lg border-r border-spiritual-200 shadow-strong">

            <div class="h-full flex flex-col">

                <!-- Logo & Brand -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-spiritual-200">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('favicon.png') }}" alt="Examine" class="w-10 h-10 rounded-xl">
                        <span class="text-xl font-bold text-spiritual-900">Examine</span>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 overflow-y-auto py-4">
                    <div class="px-3 space-y-1">

                        <!-- Dashboard -->
                        <a href="{{ route('student.dashboard') }}"
                            wire:navigate
                            :class="currentPage === 'dashboard' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-layout-dashboard class="w-5 h-5" />
                            <span class="font-medium">Dashboard</span>
                        </a>

                        <!-- My Exams -->
                        <a href="{{ route('student.exams') }}"
                            wire:navigate
                            :class="currentPage === 'exams' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-book-open class="w-5 h-5" />
                            <span class="font-medium">My Exams</span>
                        </a>

                        <!-- Practice Tests -->
                        <a href="{{ route('student.practice') }}"
                            wire:navigate
                            :class="currentPage === 'practice' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-trophy class="w-5 h-5" />
                            <span class="font-medium">Practice Tests</span>
                        </a>

                        <!-- Results -->
                        <a href="{{ route('student.results') }}"
                            wire:navigate
                            :class="currentPage === 'results' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-bar-chart-3 class="w-5 h-5" />
                            <span class="font-medium">Results</span>
                        </a>

                        <!-- Performance -->
                        <a href="{{ route('student.performance') }}"
                            wire:navigate
                            :class="currentPage === 'performance' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-trending-up class="w-5 h-5" />
                            <span class="font-medium">Performance</span>
                        </a>

                        <!-- Subjects -->
                        <a href="{{ route('student.subjects') }}"
                            wire:navigate
                            :class="currentPage === 'subjects' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-layers class="w-5 h-5" />
                            <span class="font-medium">Subjects</span>
                        </a>

                        <div class="my-3 border-t border-spiritual-200"></div>

                        <!-- Settings -->
                        <a href="{{ route('student.settings') }}"
                            wire:navigate
                            :class="currentPage === 'settings' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-settings class="w-5 h-5" />
                            <span class="font-medium">Settings</span>
                        </a>

                        <!-- Help -->
                        <a href="{{ route('student.help') }}"
                            wire:navigate
                            :class="currentPage === 'help' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group">
                            <x-lucide-help-circle class="w-5 h-5" />
                            <span class="font-medium">Help & Support</span>
                        </a>

                    </div>
                </nav>

                <!-- Logout Button -->
                <div class="px-6 py-4 border-t border-spiritual-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full px-4 py-3 rounded-xl text-spiritual-700 hover:bg-error-50 hover:text-error-600 transition-all duration-300">
                            <x-lucide-log-out class="w-5 h-5" />
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>

            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen {{ (isset($currentPage) && $currentPage === 'mock-exam') ? 'pb-0' : 'pb-20 lg:pb-0' }}"> <!-- Top Header Bar (Hidden on Mock Exam) -->
            @if((isset($currentPage) && $currentPage !== 'mock-exam') || !isset($currentPage))
            <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-spiritual-200 shadow-soft">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">

                        <!-- Mobile Menu Toggle -->
                        <button
                            @click="sidebarOpen = !sidebarOpen"
                            class="text-spiritual-600 hover:text-primary-600 transition-colors lg:hidden">
                            <x-lucide-menu class="w-6 h-6" />
                        </button>

                        <!-- Page Title -->
                        <div class="hidden lg:block">
                            <h1 class="text-2xl font-bold text-spiritual-900">{{ $pageTitle ?? 'Dashboard' }}</h1>
                            @isset($pageDescription)
                            <p class="text-sm text-spiritual-600 mt-1">{{ $pageDescription }}</p>
                            @endisset
                        </div>

                        <!-- Right Side Actions -->
                        <div class="flex items-center space-x-4">

                            <!-- Notifications -->
                            <div class="relative" x-data="{ open: false }">
                                <button
                                    @click="open = !open"
                                    class="relative p-2 text-spiritual-600 hover:text-primary-600 transition-colors rounded-lg hover:bg-spiritual-50">
                                    <x-lucide-bell class="w-5 h-5" />
                                    <span class="absolute top-1 right-1 w-2 h-2 bg-error-500 rounded-full"></span>
                                </button>

                                <!-- Notifications Dropdown -->
                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-strong border border-spiritual-200 py-2 z-50"
                                    style="display: none;">

                                    <div class="px-4 py-3 border-b border-spiritual-200">
                                        <h3 class="font-semibold text-spiritual-900">Notifications</h3>
                                    </div>

                                    <div class="max-h-96 overflow-y-auto">
                                        <div class="px-4 py-3 hover:bg-spiritual-50 cursor-pointer transition-colors">
                                            <p class="text-sm font-medium text-spiritual-900">New exam available</p>
                                            <p class="text-xs text-spiritual-600 mt-1">JAMB Physics Mock - 2025</p>
                                            <p class="text-xs text-spiritual-500 mt-1">2 hours ago</p>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-spiritual-50 cursor-pointer transition-colors">
                                            <p class="text-sm font-medium text-spiritual-900">Result published</p>
                                            <p class="text-xs text-spiritual-600 mt-1">Your Chemistry exam result is now available</p>
                                            <p class="text-xs text-spiritual-500 mt-1">1 day ago</p>
                                        </div>
                                    </div>

                                    <div class="px-4 py-3 border-t border-spiritual-200">
                                        <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-medium">View all notifications</a>
                                    </div>
                                </div>
                            </div>

                            <!-- User Menu -->
                            <div class="relative" x-data="{ open: false }">
                                <button
                                    @click="open = !open"
                                    class="flex items-center space-x-2 p-2 rounded-lg hover:bg-spiritual-50 transition-colors">
                                    <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <x-lucide-chevron-down class="w-4 h-4 text-spiritual-600" />
                                </button>

                                <!-- User Dropdown -->
                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-strong border border-spiritual-200 py-2 z-50"
                                    style="display: none;">

                                    <div class="px-4 py-3 border-b border-spiritual-200">
                                        <p class="text-sm font-semibold text-spiritual-900">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-spiritual-600 mt-1">{{ auth()->user()->email }}</p>
                                    </div>

                                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-spiritual-700 hover:bg-spiritual-50 transition-colors">
                                        <x-lucide-user class="w-4 h-4" />
                                        <span>My Profile</span>
                                    </a>

                                    <a href="{{ route('student.settings') }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-spiritual-700 hover:bg-spiritual-50 transition-colors">
                                        <x-lucide-settings class="w-4 h-4" />
                                        <span>Settings</span>
                                    </a>

                                    <div class="border-t border-spiritual-200 my-2"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-2 w-full px-4 py-2 text-sm text-error-600 hover:bg-error-50 transition-colors">
                                            <x-lucide-log-out class="w-4 h-4" />
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 {{ (isset($currentPage) && $currentPage === 'mock-exam') ? '' : 'p-4 sm:p-6 lg:p-8' }}">
                {{ $slot }}
            </main>

            <!-- Footer (Hidden on Mock Exam) -->
            @if((isset($currentPage) && $currentPage !== 'mock-exam') || !isset($currentPage))
            <footer class="hidden lg:block bg-white/50 border-t border-spiritual-200 mt-12">
                <div class="px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <p class="text-sm text-spiritual-600">&copy; {{ date('Y') }} Examine CBT. All rights reserved.</p>
                        <div class="flex items-center space-x-6 text-sm text-spiritual-600">
                            <a href="#" class="hover:text-primary-600 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-primary-600 transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-primary-600 transition-colors">Help</a>
                        </div>
                    </div>
                </div>
            </footer>
            @endif

        </div>

        <!-- Mobile Bottom Navigation (SM & MD screens only, hidden on mock exam) -->
        @if((isset($currentPage) && $currentPage !== 'mock-exam') || !isset($currentPage))
        <nav class="fixed bottom-0 left-0 right-0 lg:hidden z-50 bg-white/95 backdrop-blur-md border-t border-spiritual-200 shadow-strong">
            <div class="flex items-center justify-around h-20">
                <!-- Dashboard -->
                <a href="{{ route('student.dashboard') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.dashboard') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-layout-dashboard class="w-6 h-6" />
                    <span class="text-xs font-medium">Dashboard</span>
                </a>

                <!-- Practice -->
                <a href="{{ route('student.practice') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.practice') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-play class="w-6 h-6" />
                    <span class="text-xs font-medium">Practice</span>
                </a>

                <!-- Results -->
                <a href="{{ route('student.results') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.results') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-bar-chart-3 class="w-6 h-6" />
                    <span class="text-xs font-medium">Results</span>
                </a>

                <!-- Profile -->
                <a href="{{ route('student.settings') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.settings') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-user class="w-6 h-6" />
                    <span class="text-xs font-medium">Profile</span>
                </a>
            </div>
        </nav>
        @endif

        <!-- Mobile Sidebar Overlay (removed since we're not using sliding sidebar anymore) -->
        <!-- Exam-only quit button (Mock Exam mode) -->
        @if(isset($currentPage) && $currentPage === 'mock-exam')
        <div class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-spiritual-200 h-16 flex items-center justify-between px-4">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('favicon.png') }}" alt="Examine" class="w-8 h-8 rounded-lg">
                <span class="font-semibold text-spiritual-900">Examine</span>
            </div>
            <a href="{{ route('student.dashboard') }}"
                wire:navigate
                class="flex items-center space-x-2 px-4 py-2 rounded-lg bg-error-50 text-error-600 hover:bg-error-100 transition-all duration-300 font-medium">
                <x-lucide-x class="w-5 h-5" />
                <span class="hidden sm:inline">Quit Exam</span>
                <span class="sm:hidden">Quit</span>
            </a>
        </div>
        @endif

        @livewireScripts
</body>

</html>