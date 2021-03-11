<x-guest-layout>
<div class="p-4">


    <section class="text-gray-700 body-font">

            <div class="container px-2  md:px-8 mx-auto pt-12 lg:px-4">
                <div class="flex flex-col w-full mb-12 text-left">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-20 h-20 mx-auto mb-5 text-blue-800 border-2 rounded-full">
                        <x-jet-application-logo></x-jet-application-logo>
                    </div>
                    <h1 class="mb-6 text-2xl font-semibold tracking-tighter text-gray-800 sm:text-6xl title-font fzial text-center">
                        {{config('app.name')}}
                        <br class="">
                        <h1 class="text-center text-xl">@lang('main.About')</h1>
                    </h1>
                    <div class="mx-auto my-8 p-4 text-base font-medium leading-relaxed text-gray-700 ">
                   @if($content2)
                   {!! $content2 !!}

                   @else
                   {!! __('pages.about.content')!!}
                   @endif


                    </div>
                </div>
        </section>


</div>
</x-guest-layout>
