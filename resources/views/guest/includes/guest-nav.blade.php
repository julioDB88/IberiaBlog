<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                    <p class="fzial text-xl hidden space-x-4 sm:-my-px sm:ml-4 sm:flex">{{ config('app.name') }}</p>
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @php
                $categories = \App\Models\Category::all();
                @endphp
                <x-jet-dropdown>
                    <x-slot name="trigger">
                        <button type="button"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">{{ __('News') }}</button>
                    </x-slot>

                    <x-slot name="content">
                        @foreach ($categories as $cat)
                        <x-jet-dropdown-link href="{{ route('news.category',$cat->slug) }}">
                            {{ $cat->name }}
                        </x-jet-dropdown-link>
                        @endforeach

                    </x-slot>
                </x-jet-dropdown>
                <x-jet-nav-link href="{{ route('page.show','about')  }}" :active="request()->routeIs('dashboard')">
                    {{ __('About') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('page.show','contact')  }}" :active="request()->routeIs('dashboard')">
                    {{ __('Contact') }}
                </x-jet-nav-link>
                @auth
                @writer
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
                @endwriter
                @admin
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
                @endadmin

                @endauth

            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>
        </div>


    </div>
</nav>
