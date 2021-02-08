<div class="w-full md:w-4/5">
    <div class="header-section w-full text-xl md:text-3xl py-16 text-center">
        @lang('main.latest_news')
    </div>


    <section class="overflow-hidden text-gray-700 body-font">
        <div class="container px-3 ">
            <div class=" grid grid-cols-1 md:grid-cols-2">
                <div class="flex flex-wrap">
                    @foreach ($latest_posts as $key => $post)
                    @if(in_array($key,[0,1,2]))
                    <div class="@if(in_array($key,[0,1,4,5])) w-1/2 @else w-full @endif p-1 md:p-2">
                        <a href="{{route('news.show',$post->slug)}}">
                            <div alt="gallery"
                                class="flex items-base items-end object-contain object-center w-full rounded-lg @if(in_array($key,[0,1,4,5])) h-36 @else h-64 @endif"
                                style="background:url('{{asset('storage/posts')}}/{{$post->img_file}}') no-repeat center;">
                                <div class=" w-full main-banner rounded h-full flex justify-center items-center">
                                    <p class="text-white ">{{ ucfirst($post->title)}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach

                </div>
                <div class="flex flex-wrap">
                    @foreach ($latest_posts as $key => $post)
                    @if(in_array($key,[3,4,5]))
                    <div class="@if(in_array($key,[0,1,4,5])) w-1/2 @else w-full @endif p-1 md:p-2">
                        <a href="{{route('news.show',$post->slug)}}">
                            <div alt="gallery"
                                class="flex items-base items-end object-contain object-center w-full rounded-lg @if(in_array($key,[0,1,4,5])) h-36 @else h-64 @endif"
                                style="background:url('{{asset('storage/posts')}}/{{$post->img_file}}') no-repeat center;">
                                <div class=" w-full main-banner rounded h-full flex justify-center items-center>
                                    <p class="text-white ">{{ucfirst($post->title)}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <div class="section">
        <div class="grid grid-cols-1 md:grid-cols-3">


        </div>
    </div>
    @include('guest.includes.popnews')
</div>
