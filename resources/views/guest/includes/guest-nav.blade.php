<nav x-data="{ open: false }" class="bg-white border-b-2 border-gray-100 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-1 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="hidden md:flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                    <p class="fzial text-xl hidden space-x-4 sm:-my-px sm:ml-4 sm:flex">{{ config('app.name') }}</p>
                </div>

            </div>
            <div class="pt-2 relative mx-auto text-gray-600">
                <form action="{{route('search.posts')}}" method="get">
                <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:border-gray-500"
                  type="search" name="search" placeholder="Search">
                <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                  <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                    viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                    width="512px" height="512px">
                    <path
                      d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                  </svg>
                </button>
            </form>
              </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @php
                $categories = \App\Models\Category::all();
                @endphp
                <x-jet-dropdown>
                    <x-slot name="trigger">
                        <button type="button"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">@lang('main.News')</button>
                    </x-slot>

                    <x-slot name="content">
                        @foreach ($categories as $cat)
                        <x-jet-dropdown-link href="{{ route('news.category',$cat->slug) }}">
                            {{ $cat->name }}
                        </x-jet-dropdown-link>
                        @endforeach

                    </x-slot>
                </x-jet-dropdown>

                @php $active_about = DB::table('pages_content')->where('name','about')->first()->active @endphp
                @php $active_videos = DB::table('pages_content')->where('name','videos')->first()->active @endphp
                @php $shop = DB::table('pages_content')->where('name','shop')->first() @endphp


                @if($active_about)
                <x-jet-nav-link href="{{ route('about')  }}" :active="request()->routeIs('about')">
                    @lang('main.About')
                </x-jet-nav-link>
                @endif

                @if($active_videos)
                <x-jet-nav-link href="{{ route('videos')  }}" :active="request()->routeIs('videos')">
                    @lang('main.Videos')
                </x-jet-nav-link>
                @endif

                {{-- @if($shop->active)
                <x-jet-nav-link href="//{{ $shop->content }}" :active="request()->routeIs('dashboard')">
                    @lang('main.Shop')
                </x-jet-nav-link>
                @endif --}}

                <x-jet-nav-link href="{{ route('contact')  }}" :active="request()->routeIs('contact')">
                    @lang('main.Contact')
                </x-jet-nav-link>
                @auth


                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    @lang('main.Dashboard')
                </x-jet-nav-link>


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
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                @lang('main.Home')
            </x-jet-responsive-nav-link>
            <x-jet-dropdown >
                <x-slot name="trigger">
                    <button type="button"
                        class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">@lang('main.News')</button>
                </x-slot>
                <x-slot name="content">
                    @foreach ($categories as $cat)
                    <x-jet-dropdown-link href="{{ route('news.category',$cat->slug) }}">
                        {{ $cat->name }}
                    </x-jet-dropdown-link>
                    @endforeach
                </x-slot>
            </x-jet-dropdown>

            @if($active_videos)
            <x-jet-responsive-nav-link href="{{ route('videos')  }}" :active="request()->routeIs('videos')">
                @lang('main.Videos')
            </x-jet-responsive-nav-link >
            @endif

            @if($active_about)
            <x-jet-responsive-nav-link href="{{ route('about')  }}" :active="request()->routeIs('about')">
                @lang('main.About')
            </x-jet-responsive-nav-link>
            @endif

            {{-- @if($shop->active)
            <x-jet-responsive-nav-link href="{{ $shop->content }}" :active="request()->routeIs('about')">
                @lang('main.Shop')
            </x-jet-responsive-nav-link>
            @endif --}}

            <x-jet-responsive-nav-link href="{{ route('contact')  }}" :active="request()->routeIs('contact')">
                @lang('main.Contact')
            </x-jet-responsive-nav-link>
            @auth

            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                @lang('main.Dashboard')
            </x-jet-responsive-nav-link>

            @endauth

        </div>


    </div>
</nav>
