<div class="header-section w-full text-xl md:text-3xl py-16 text-center">
    @lang('main.pop_news')
</div>
<div class="section">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($top_comment as $tpost)
        <div class="p-4 ">
            <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden">
                <img class="lg:h-48 md:h-36 h-24 w-full object-cover object-center"
                    src="{{asset('storage/posts')}}/{{$tpost->img_file}}" alt="blog">
                <div class="p-2 md:p-6 ">
                    <h1 class="title-font text-lg font-medium text-gray-900 mb-1">{{$tpost->title}}</h1>
                    <div class="flex justify-between">
                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-3">
                            {{$tpost->Author->name}} - {{\Carbon\Carbon::parse($tpost->created_at)->format('d-m-y')}}</h2>
                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-3">
                            {{$tpost->Category->name}}</h2>

                    </div>
                    <p class="leading-relaxed mb-3">{{ mb_strimwidth($tpost->description,0,95,'...') }}</p>
                    <div class="flex items-center flex-wrap ">
                        <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0"
                            href="{{route('news.show',$tpost->slug)}}">{{__('Read More')}}
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <span
                            class="text-gray-600 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 ">
                            <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path
                                d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                            </path>
                        </svg>{{count($tpost->Comments)}}
                        </span>

                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
