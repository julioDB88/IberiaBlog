<footer class=" text-gray-700 bg-white border-t body-font">
    <div class="border-t border-gray-200">
        <div class="container flex flex-col flex-wrap items-center justify-between p-5 mx-auto md:flex-row">
            <a class="flex items-center w-48 mb-4 font-medium text-gray-900 title-font md:mb-0">
                <x-jet-application-logo></x-jet-application-logo>
            </a>
            <div class="grid items-center justify-center py-4 mx-auto text-base bg-blueGray-900 ">
                <p class="text-sm text-center text-gray-700 ">© {{config('app.name')}} — {{Carbon\Carbon::now()->format('Y')}}</p>
                <p class="p-2 text-xs md:text-base">
                     <a class="hover:text-indigo-700 hover:border-b-2 hover:border-indigo-700 cursor-pointer" href="{{route('legal.show','terms')}}">@lang('main.Terms and Conditions')</a>
                    &nbsp; @lang('main.and') &nbsp;
                    <a class="hover:text-indigo-700 hover:border-b-2 hover:border-indigo-700 cursor-pointer" href="{{route('legal.show','policy')}}">@lang('main.Privacy Policy')</a></p>
            </div>
            @php
            $socials = DB::table('social_links')->get();
            @endphp

            <div class="inline-flex items-center justify-center md:justify-start ">
                <span class="inline-flex justify-center mt-2 sm:ml-auto sm:mt-0 sm:justify-start">
                    @foreach ($socials as $ilink)
                        @if($ilink->active)
                        <a href="//{{$ilink->url}}" target="_blank" class="text-blue-807 hover:text-blue-500 mx-6">
                        <img src="{{asset('storage/logos')}}/{{$ilink->icon}}" alt="" class="h-6">
                        </a>
                        @endif
                    @endforeach



                </span>
            </div>
        </div>

    </div>
</footer>
