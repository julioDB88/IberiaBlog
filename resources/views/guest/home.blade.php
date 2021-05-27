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
        @include('guest.includes.mainhomerow')
        @include('guest.includes.relatedcontent')
    </div>

    @include('guest.includes.authors')


</x-guest-layout>

