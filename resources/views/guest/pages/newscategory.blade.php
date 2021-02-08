<x-guest-layout>
    @if (count($posts)!==0)
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<h1 class="text-lg md:text-3xl text-indigo-700 text-center font-bold tracker">{{$category}}</h1>
            <section class="text-gray-700 body-font">
                <div class="container px-8 pt-2 mx-auto lg:px-10">
                    <div class="flex flex-wrap ">
                        @foreach($posts as $post)
                        <div class="px-2 py-2 lg:w-1/3 md:w-full">
                            <div class="border rounded-xl">
                                <img class="object-cover object-center w-full h-64 rounded-t-xl"
                                    src="{{asset('storage/posts')}}/{{$post->img_file}}" alt="content">
                                <div class="p-6 ">

                                    <h2 class="mb-3 text-lg font-semibold text-gray-700 lg:text-2xl title-font">
                                        {{$post->title}}
                                    </h2>
                                    <p class="mb-4 text-base leading-relaxed">
                                        {{ mb_strimwidth($post->description,0,95,'...') }}</p>
                                    <a  href="{{route('news.show',$post->slug)}}" class="w-full px-8 py-2 font-semibold text-indigo-700 transition duration-500 ease-in-out transform bg-white border rounded-lg shadow-xl hover:text-white hover:border-black hover:bg-indigo-700 focus:shadow-outline focus:outline-none">@lang('main.Read')</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>


        </div>
    </div>
    @else
    <p class="font-bold text-center py-4">@lang('main.Nothing to show')</p>
    @endif
</x-guest-layout>
