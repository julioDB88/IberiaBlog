<x-guest-layout>
    <div class="h-80 c-shadow">
        <video autoplay muted loop class=" absolute h-80 min-w-full object-cover">
            <source src="{{asset('media')}}/bg-video.mp4" type="video/mp4">
        </video>
        <div class="w-full z-0 text-center h-80 absolute main-banner p-20 md:p-32">
            <img src="{{asset('media')}}/logo.png" alt="{{config('app.name')}}" height="300" width="300"
                class="mx-auto">
            <div class="inline-block">
                <p class="text-white fzial text-3xl pb-6"> {{ config('app.name') }}</p>
                <p class="text-white hidden md:block md:text-2xl">@lang('main.lema')</p>
            </div>
        </div>

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
                        {{-- foreach --}}
                        <div class="">
                            <div class="h-full text-left">
                                <a class="inline-flex items-center py-6">
                                    <img alt="testimonial"
                                        class="inline-block object-cover object-center w-16 h-16 bg-gray-100 rounded-full"
                                        src="https://dummyimage.com/302x302/94a3b8/ffffff"> <span
                                        class="flex flex-col flex-grow pl-4">
                                        <span class="font-medium  title-font text-white font-bold">Adi Pio</span>
                                        <span class="text-sm  uppercase text-white ">Corporate Position</span>
                                    </span>
                                </a>
                                <p class="text-base font-medium leading-relaxed text-white">"Skate ipsum dolor sit
                                    amet, slam birdie wheels ollie darkslide egg plant. Baseplate 540 helipop flypaper
                                    feeble griptape."</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


        </div>
    </div>

</x-guest-layout>
