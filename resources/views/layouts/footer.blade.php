<footer class=" text-gray-700 bg-white border-t body-font">
    <div class="border-t border-gray-200">
        <div class="container flex flex-col flex-wrap items-center justify-between p-5 mx-auto md:flex-row">
            <a class="flex items-center w-48 mb-4 font-medium text-gray-900 title-font md:mb-0">
                <x-jet-application-logo></x-jet-application-logo>
            </a>
            <div class="grid items-center justify-center py-4 mx-auto text-base bg-blueGray-900 ">
                <p class="text-sm text-center text-gray-700 ">© {{config('app.name')}} — {{Carbon\Carbon::now()->format('Y')}}</p>
                <p class="p-2 text-xs md:text-base"> <a href="{{route('legal.show','terms')}}">{{__('Terms and Conditions')}}</a>&nbsp; and &nbsp;<a href="{{route('legal.show','policy')}}">{{__('Privacy Policy')}}</a></p>
            </div>
            @php
            $socials = DB::table('social_links')->get();
            @endphp

            <div class="inline-flex items-center justify-center md:justify-start ">
                <span class="inline-flex justify-center mt-2 sm:ml-auto sm:mt-0 sm:justify-start">
                    @foreach ($socials as $ilink)
                        @if($ilink->active)
                        <a href="//{{$ilink->url}}" target="_blank" class="text-blue-807 hover:text-blue-500 mx-6">
                            @if($ilink->name=='facebook')
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>


                            @elseif($ilink->name=='twitter')
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-5 h-5" viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                </path>
                            </svg>
                            @elseif($ilink->name=='instagram')
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                            </svg>
                            @endif</a>
                        @endif
                    @endforeach



                </span>
            </div>
        </div>

    </div>
</footer>
