<x-guest-layout>
    <div class="c-shadow relative flex justify-center items-center">
        <div class="w-full text-center h-full main-banner py-16 z-10">
            <img src="{{asset('media')}}/logo.png" alt="{{config('app.name')}}" class="h-32 md:h-64 mx-auto"
                class="mx-auto">
            <div class="text-center">
                <p class="text-white fzial text-3xl pb-6"> {{ config('app.name') }}</p>
                <p class="text-white hidden md:block md:text-2xl">@lang('main.lema')</p>
            </div>
        </div>
        <video autoplay muted loop class=" absolute h-full min-w-full min-h-auto object-cover">
            <source src="{{asset('media')}}/bg-video.mp4" type="video/mp4">
        </video>


    </div>
    <div class="flex">
        @include('guest.includes.latestnews')
       @include('guest.includes.relatedcontent')
    </div>


    <div class="section bg-gray-700">
        <div class="header-section w-full text-xl md:text-3xl py-8 text-center text-white">
            @lang('main.authors')
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 ">

            <section class="text-gray-700 body-font ">
                <div class="container p-6">
                    <div class="flex flex-wrap">
                        @foreach (User::all() as $user)
                        <div class="">
                            <div class="h-full text-left bg-indigo-700 rounded p-5">
                                <a class="inline-flex items-center py-6">
                                    @if($user->profile_foto_url)
                                    <img alt="testimonial"
                                        class="inline-block object-cover object-center w-16 h-16 bg-gray-100 rounded-full"
                                        src="{{$user->profile_foto_url}}">

                                    @else
                                    <img alt="testimonial"
                                    class="inline-block object-cover object-center w-16 h-16 bg-gray-100 rounded-full"
                                    src="{{asset('media')}}/anon.svg">
                                    @endif
                                        <span
                                        class="flex flex-col flex-grow pl-4">
                                        <span class="font-medium  title-font text-white font-bold">{{$user->name}}</span>
                                        <span class="text-sm  uppercase text-white ">{{$user->subtitle}}</span>
                                    </span>
                                </a>
                                @if($user->description)
                                <p class="text-base font-medium leading-relaxed text-white">{{$user->description}}</p>
                                @else
                                <p class="text-base font-medium leading-relaxed text-white">@lang('main.author_placeholder')</p>
                                @endif
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </section>


        </div>
    </div>

</x-guest-layout>
