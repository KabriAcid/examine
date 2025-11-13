<x-guest-layout>
    <x-slot name="title">Sign Up - Examine CBT</x-slot>

    <div class="flex items-center justify-center p-4 min-h-screen">
        <div class="w-full max-w-md">

            <!-- Card -->
            <div
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 200)"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-5"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="card">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-spiritual-900 mb-2">Sign Up</h1>
                    <p class="text-spiritual-600">Just a few quick things to get started</p>
                </div>

                <form method="POST" action="{{ route('register') }}" x-data="{ loading: false, agreeToTerms: false }" @submit="loading = true" class="space-y-6">
                    @csrf

                    <!-- Error Alert -->
                    @if ($errors->any())
                    <div class="p-3 bg-error-50 border border-error-200 rounded-xl text-error-600 text-sm">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-spiritual-700 mb-2">
                            Email ID
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter Email ID"
                            class="input-field @error('email') border-error-500 focus:border-error-500 focus:ring-error-500/20 @enderror" />
                        @error('email')
                        <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <!-- Password -->
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="block text-sm font-medium text-spiritual-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                autocomplete="new-password"
                                placeholder="Enter Password"
                                class="input-field @error('password') border-error-500 focus:border-error-500 focus:ring-error-500/20 @enderror ${showPasswordToggle ? 'pr-12' : ''}" />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-spiritual-400 hover:text-spiritual-600">
                                <x-lucide-eye x-show="!showPassword" class="w-5 h-5" />
                                <x-lucide-eye-off x-show="showPassword" x-cloak class="w-5 h-5" />
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div x-data="{ showPassword: false }">
                        <label for="password_confirmation" class="block text-sm font-medium text-spiritual-700 mb-2">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                :type="showPassword ? 'text' : 'password'"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Enter Confirm Password"
                                class="input-field @error('password_confirmation') border-error-500 focus:border-error-500 focus:ring-error-500/20 @enderror ${showPasswordToggle ? 'pr-12' : ''}" />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-spiritual-400 hover:text-spiritual-600">
                                <x-lucide-eye x-show="!showPassword" class="w-5 h-5" />
                                <x-lucide-eye-off x-show="showPassword" x-cloak class="w-5 h-5" />
                            </button>
                        </div>
                        @error('password_confirmation')
                        <p class="mt-1 text-sm text-error-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="space-y-2">
                        <label class="flex items-start space-x-3">
                            <input
                                type="checkbox"
                                name="agreeToTerms"
                                x-model="agreeToTerms"
                                class="w-4 h-4 text-primary-600 border-spiritual-300 rounded focus:ring-primary-500 mt-0.5" />
                            <span class="text-sm text-spiritual-600 leading-relaxed">
                                I Agree With The <a href="/terms" class="text-primary-600 hover:text-primary-700">Terms And Conditions</a>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="btn-primary w-full"
                        :disabled="loading || !agreeToTerms">
                        <svg x-show="loading" x-cloak class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="loading ? 'Creating Account...' : 'Sign Up'"></span>
                    </button>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-spiritual-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-spiritual-500">Or with</span>
                        </div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button type="button" class="btn-secondary flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span>Facebook</span>
                        </button>
                        <button type="button" class="btn-secondary flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            <span>Google</span>
                        </button>
                    </div>

                    <!-- Sign In Link -->
                    <div class="text-center">
                        <span class="text-spiritual-600">Already have an account? </span>
                        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-medium">
                            Sign In
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>