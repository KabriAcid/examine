<div>
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-primary-500 to-secondary-600 rounded-3xl p-8 mb-8 shadow-strong text-white"
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 100)"
        x-show="show"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h2>
                <p class="text-primary-100">Ready to ace your exams? Let's keep the momentum going!</p>
            </div>
            <div class="hidden md:block">
                <x-lucide-rocket class="w-20 h-20 opacity-20" />
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Total Exams -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 200)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-spiritual-600 mb-1">Total Exams</p>
                    <p class="text-3xl font-bold text-spiritual-900">{{ $stats['total_exams'] }}</p>
                </div>
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                    <x-lucide-book-open class="w-6 h-6 text-primary-600" />
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-success-600 font-medium">+3 this week</span>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 300)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-spiritual-600 mb-1">Completed</p>
                    <p class="text-3xl font-bold text-spiritual-900">{{ $stats['completed'] }}</p>
                </div>
                <div class="w-12 h-12 bg-success-100 rounded-xl flex items-center justify-center">
                    <x-lucide-badge-check class="w-6 h-6 text-success-600" />
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-spiritual-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-success-500 to-success-600 h-2 rounded-full"
                        style="width: {{ ($stats['completed'] / $stats['total_exams']) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Average Score -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 400)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-spiritual-600 mb-1">Avg Score</p>
                    <p class="text-3xl font-bold text-spiritual-900">{{ $stats['average_score'] }}%</p>
                </div>
                <div class="w-12 h-12 bg-secondary-100 rounded-xl flex items-center justify-center">
                    <x-lucide-trending-up class="w-6 h-6 text-secondary-600" />
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <x-lucide-arrow-up class="w-4 h-4 text-success-600 mr-1" />
                <span class="text-success-600 font-medium">+5% from last week</span>
            </div>
        </div>

        <!-- Class Rank -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 500)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-spiritual-600 mb-1">Class Rank</p>
                    <p class="text-3xl font-bold text-spiritual-900">#{{ $stats['rank'] }}</p>
                </div>
                <div class="w-12 h-12 bg-warning-100 rounded-xl flex items-center justify-center">
                    <x-lucide-trophy class="w-6 h-6 text-warning-600" />
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-spiritual-600">Out of 120 students</span>
            </div>
        </div>

    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Upcoming Exams -->
        <div class="lg:col-span-2">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-spiritual-900">Upcoming Exams</h3>
                    <a href="{{ route('student.exams') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center">
                        View All
                        <x-lucide-arrow-right class="w-4 h-4 ml-1" />
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($upcomingExams as $exam)
                    <div class="border border-spiritual-200 rounded-xl p-4 hover:border-primary-300 hover:shadow-medium transition-all duration-300 group cursor-pointer">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-semibold text-spiritual-900 group-hover:text-primary-600 transition-colors">{{ $exam['title'] }}</h4>
                                <div class="flex items-center space-x-4 mt-3 text-sm text-spiritual-600">
                                    <div class="flex items-center space-x-1">
                                        <x-lucide-book class="w-4 h-4" />
                                        <span>{{ $exam['subject'] }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <x-lucide-clock class="w-4 h-4" />
                                        <span>{{ $exam['duration'] }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <x-lucide-file-question class="w-4 h-4" />
                                        <span>{{ $exam['questions'] }} Questions</span>
                                    </div>
                                </div>
                                <div class="mt-2 text-xs text-spiritual-500">
                                    Scheduled: {{ $exam['scheduled_at']->format('M d, Y - h:i A') }}
                                </div>
                            </div>
                            <button
                                wire:click="startExam({{ $exam['id'] }})"
                                class="ml-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-medium transition-all duration-300 hover:scale-105">
                                Start
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <x-lucide-calendar-x class="w-16 h-16 text-spiritual-300 mx-auto mb-4" />
                        <p class="text-spiritual-600">No upcoming exams</p>
                        <a href="{{ route('student.practice') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium mt-2 inline-block">
                            Browse Practice Tests
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Results -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20 mt-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-spiritual-900">Recent Results</h3>
                    <a href="{{ route('student.results') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center">
                        View All
                        <x-lucide-arrow-right class="w-4 h-4 ml-1" />
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($recentResults as $result)
                    <div class="flex items-center justify-between p-4 border border-spiritual-200 rounded-xl hover:border-primary-300 transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center
                                {{ $result['status'] === 'passed' ? 'bg-success-100' : 'bg-error-100' }}">
                                @if($result['status'] === 'passed')
                                <x-lucide-badge-check class="w-6 h-6 text-success-600" />
                                @else
                                <x-lucide-x-circle class="w-6 h-6 text-error-600" />
                                @endif
                            </div>
                            <div>
                                <h4 class="font-semibold text-spiritual-900">{{ $result['exam'] }}</h4>
                                <p class="text-sm text-spiritual-600 mt-1">{{ $result['date']->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold {{ $result['percentage'] >= 70 ? 'text-success-600' : 'text-error-600' }}">
                                {{ $result['percentage'] }}%
                            </p>
                            <p class="text-sm text-spiritual-600">{{ $result['score'] }}/{{ $result['total'] }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <x-lucide-bar-chart-3 class="w-16 h-16 text-spiritual-300 mx-auto mb-4" />
                        <p class="text-spiritual-600">No results yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20">
                <h3 class="text-lg font-bold text-spiritual-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('student.practice') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-primary-50 hover:border-primary-200 border border-transparent transition-all duration-300 group">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                            <x-lucide-play class="w-5 h-5 text-primary-600" />
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-spiritual-900">Start Practice</p>
                            <p class="text-xs text-spiritual-600">Take a quick test</p>
                        </div>
                    </a>

                    <a href="{{ route('student.results') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-secondary-50 hover:border-secondary-200 border border-transparent transition-all duration-300 group">
                        <div class="w-10 h-10 bg-secondary-100 rounded-lg flex items-center justify-center group-hover:bg-secondary-200 transition-colors">
                            <x-lucide-bar-chart-3 class="w-5 h-5 text-secondary-600" />
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-spiritual-900">View Results</p>
                            <p class="text-xs text-spiritual-600">Check performance</p>
                        </div>
                    </a>

                    <a href="{{ route('student.subjects') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-success-50 hover:border-success-200 border border-transparent transition-all duration-300 group">
                        <div class="w-10 h-10 bg-success-100 rounded-lg flex items-center justify-center group-hover:bg-success-200 transition-colors">
                            <x-lucide-layers class="w-5 h-5 text-success-600" />
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-spiritual-900">Browse Subjects</p>
                            <p class="text-xs text-spiritual-600">Explore topics</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Best Subject -->
            <div class="bg-gradient-to-br from-warning-500 to-warning-600 rounded-2xl p-6 shadow-strong text-white">
                <div class="flex items-center space-x-3 mb-4">
                    <x-lucide-star class="w-6 h-6" />
                    <h3 class="font-bold text-lg">Best Subject</h3>
                </div>
                <p class="text-3xl font-bold mb-2">{{ $stats['best_subject'] }}</p>
                <p class="text-warning-100 text-sm">Keep up the great work!</p>
            </div>

            <!-- Study Tips -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20">
                <div class="flex items-center space-x-2 mb-4">
                    <x-lucide-lightbulb class="w-5 h-5 text-primary-600" />
                    <h3 class="text-lg font-bold text-spiritual-900">Study Tip</h3>
                </div>
                <p class="text-sm text-spiritual-700 leading-relaxed">
                    Practice with past questions regularly. Focus on understanding concepts rather than memorizing answers. Review your mistakes after each test!
                </p>
            </div>

        </div>

    </div>
</div>