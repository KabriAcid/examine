<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Examine CBT') }} - Master JAMB & WAEC Exams</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50">
        <!-- Hero Section -->
        <section class="relative pt-20 pb-16 overflow-hidden">
            <div class="absolute inset-0 islamic-bg opacity-30"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-8">
                    <div
                        x-data="{ show: false }"
                        x-init="setTimeout(() => show = true, 100)"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-800"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="space-y-4">
                        <h1 class="text-4xl md:text-6xl font-bold text-spiritual-900 leading-tight">
                            Master Your
                            <span class="text-gradient block">Exam Preparation</span>
                        </h1>
                        <p class="text-lg md:text-xl text-spiritual-600 max-w-3xl mx-auto leading-relaxed">
                            Ace your JAMB, WAEC, and NECO exams with AI-powered practice tests,
                            compete with peers, and track your academic progress in real-time.
                        </p>
                    </div>

                    <div
                        x-data="{ show: false }"
                        x-init="setTimeout(() => show = true, 300)"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-800"
                        x-transition:enter-start="opacity-0 translate-y-5"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary group">
                            <!-- Play Icon (Lucide) -->
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Start Practicing
                            <!-- ArrowRight Icon (Lucide) -->
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="btn-primary group">
                            <!-- Play Icon (Lucide) -->
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Start Learning
                            <!-- ArrowRight Icon (Lucide) -->
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        @endauth
                        <a href="#featured-exams" class="btn-secondary">
                            <!-- Trophy Icon (Lucide) -->
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            View Leaderboard
                        </a>
                    </div>
                </div>

                <!-- Hero Illustration -->
                <div
                    x-data="{ show: false }"
                    x-init="setTimeout(() => show = true, 500)"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-80"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="mt-16 relative">
                    <div class="w-full max-w-md mx-auto">
                        <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-strong">
                            <div class="text-center space-y-4">
                                <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl mx-auto flex items-center justify-center animate-bounce-gentle">
                                    <!-- BookOpen Icon (Lucide) -->
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-spiritual-900">Ready to Begin?</h3>
                                <p class="text-spiritual-600">Choose from thousands of exam questions across all subjects</p>
                                <div class="flex items-center justify-center space-x-2 text-sm text-spiritual-500">
                                    <!-- Star Icon (Lucide) -->
                                    <svg class="w-4 h-4 text-warning-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                    <span>Trusted by 10,000+ students</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-white/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @php
                    $stats = [
                    [
                    'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />',
                    'label' => 'Active Students',
                    'value' => '10,000+',
                    'color' => 'text-primary-600'
                    ],
                    [
                    'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
                    'label' => 'Practice Questions',
                    'value' => '50,000+',
                    'color' => 'text-secondary-600'
                    ],
                    [
                    'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />',
                    'label' => 'Tests Completed',
                    'value' => '100,000+',
                    'color' => 'text-success-600'
                    ],
                    [
                    'icon' => '
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />',
                    'label' => 'Success Rate',
                    'value' => '92%',
                    'color' => 'text-warning-600'
                    ]
                    ];
                    @endphp

                    @foreach($stats as $index => $stat)
                    <div
                        x-data="{ show: false }"
                        x-intersect="show = true"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-600 delay-{{ $index * 100 }}"
                        x-transition:enter-start="opacity-0 translate-y-5"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="text-center space-y-2">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center {{ $stat['color'] }}">
                            <svg class="w-6 h-6" fill="{{ str_contains($stat['icon'], 'fill') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $stat['icon'] !!}
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-spiritual-900">{{ $stat['value'] }}</div>
                        <div class="text-sm text-spiritual-600">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Exams -->
        <section id="featured-exams" class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    x-data="{ show: false }"
                    x-intersect="show = true"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-600"
                    x-transition:enter-start="opacity-0 translate-y-5"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-spiritual-900 mb-4">
                        Featured Mock Exams
                    </h2>
                    <p class="text-lg text-spiritual-600 max-w-2xl mx-auto">
                        Start your preparation with these carefully designed mock tests based on past JAMB, WAEC, and NECO questions.
                    </p>
                </div>

                @php
                $featuredExams = [
                [
                'id' => 1,
                'title' => 'JAMB Mathematics',
                'description' => 'Comprehensive practice test covering all JAMB mathematics topics',
                'subject' => 'Mathematics',
                'timeLimit' => 120,
                'difficulty' => 'medium',
                'totalPoints' => 400,
                'questions' => 40,
                'emoji' => '🧮'
                ],
                [
                'id' => 2,
                'title' => 'WAEC English Language',
                'description' => 'Master WAEC English comprehension, grammar, and oral English',
                'subject' => 'English',
                'timeLimit' => 180,
                'difficulty' => 'easy',
                'totalPoints' => 500,
                'questions' => 50,
                'emoji' => '📚'
                ],
                [
                'id' => 3,
                'title' => 'JAMB Chemistry',
                'description' => 'Practice organic, inorganic, and physical chemistry questions',
                'subject' => 'Chemistry',
                'timeLimit' => 120,
                'difficulty' => 'hard',
                'totalPoints' => 400,
                'questions' => 40,
                'emoji' => '⚗️'
                ]
                ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredExams as $index => $exam)
                    <div
                        x-data="{ show: false }"
                        x-intersect="show = true"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-600 delay-{{ $index * 100 }}"
                        x-transition:enter-start="opacity-0 translate-y-5"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="quiz-card group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center text-2xl">
                                    {{ $exam['emoji'] }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-spiritual-900 group-hover:text-primary-600 transition-colors">
                                        {{ $exam['title'] }}
                                    </h3>
                                    <p class="text-sm text-spiritual-500 capitalize">{{ $exam['subject'] }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium capitalize
                                    @if($exam['difficulty'] === 'easy') text-success-600 bg-success-100
                                    @elseif($exam['difficulty'] === 'medium') text-warning-600 bg-warning-100
                                    @else text-error-600 bg-error-100
                                    @endif">
                                {{ $exam['difficulty'] }}
                            </span>
                        </div>

                        <p class="text-spiritual-600 text-sm mb-4 line-clamp-2">
                            {{ $exam['description'] }}
                        </p>

                        <div class="flex items-center justify-between text-sm text-spiritual-500 mb-6">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-1">
                                    <!-- Clock Icon (Lucide) -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $exam['timeLimit'] }}m</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <!-- Star Icon (Lucide) -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <span>{{ $exam['totalPoints'] }} pts</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <!-- Users Icon (Lucide) -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>{{ $exam['questions'] }} questions</span>
                                </div>
                            </div>
                        </div>

                        @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary w-full group">
                            <span>Start Exam</span>
                            <!-- ArrowRight Icon (Lucide) -->
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="btn-primary w-full group">
                            <span>Start Exam</span>
                            <!-- ArrowRight Icon (Lucide) -->
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        @endauth
                    </div>
                    @endforeach
                </div>

                <div
                    x-data="{ show: false }"
                    x-intersect="show = true"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-600"
                <div 
                    x-data="{ show: false }"
                    x-intersect="show = true"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-600"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="text-center mt-12"
                >
                    <a href="{{ route('login') }}" class="btn-secondary inline-flex items-center">
                        <span>View All Exams</span>
                        <!-- ArrowRight Icon (Lucide) -->
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m0 0l-7-7m7 7l-7 7"/>
                        </svg>
                    </a>
                </div>="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div
                    x-data="{ show: false }"
                    x-intersect="show = true"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-600"
                    x-transition:enter-start="opacity-0 translate-y-5"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="space-y-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white">
                        Ready to Ace Your Exams?
                    </h2>
                    <p class="text-xl text-primary-100 max-w-2xl mx-auto">
                        Join thousands of Nigerian students preparing for JAMB, WAEC, and NECO with our AI-powered mock tests.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center font-medium rounded-xl transition-all duration-300 bg-white text-primary-600 hover:bg-primary-50 shadow-medium hover:shadow-strong hover:scale-105 active:scale-95 px-6 py-3">
                            <!-- Play Icon (Lucide) -->
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center font-medium rounded-xl transition-all duration-300 bg-white text-primary-600 hover:bg-primary-50 shadow-medium hover:shadow-strong hover:scale-105 active:scale-95 px-6 py-3">
                            <!-- Play Icon (Lucide) -->
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                            Start Your First Test
                        </a>
                        <a href="#featured-exams" class="inline-flex items-center justify-center font-medium rounded-xl transition-all duration-300 text-white border-2 border-white hover:bg-white/10 px-6 py-3">
                            Learn More
                        </a>
                    </div>