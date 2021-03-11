@push('meta')
<meta name="description" content="{{$post->description}}" />
<meta name="keywords" content="{{$post->keywords}}" />
<title>{{config('app.name')}} | {{$post->title}}</title>
@endpush
<style>
    .tinymce>p,
    h3,
    h1,
    h2,
    h4,
    h5 {
        margin: 4px !important;
        padding: 4px !important;

    }



    .logo {
        margin: auto !important;
    }
</style>
<x-news-layout>

    <div class="flex">

        <div class="md:w-4/5">
            <section class=" block">
                <div class="container flex flex-col items-center justify-center px-10 pt-8 mx-auto lg:px-32 h-48">
                    <img class="object-cover object-center mx-auto mb-10 rounded-lg lg:w-full md:w-15/5 w-20/6 h-full"
                        alt="{{config('app.name')}} | {{$post->title}}" src="{{asset('storage/posts')}}/{{$post->img_file}}">
                </div>
            </section>
            <section class="text-gray-700 body-font">
                <div class="container px-2 md:px-8 pt-2 pb-2 mx-auto lg:px-4">
                    <div class="flex flex-col w-full mb-6 text-left lg:text-center">

                        <h1 class="mb-6 text-2xl text-center font-semibold tracking-tighter text-blue-800 sm:text-3xl title-font">
                            {{$post->title}}
                        </h1>
                        <div class="flex w-full items-center justify-end">
                           <p class="mr-4">@lang('main.share')</p>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" target="_blank">
                                <img src="{{asset('media/logos/facebook.svg')}}" alt="" class="h-6 mr-4">
                            </a>
                            <a href="whatsapp://send?text={{Request::url()}}" data-action="share/whatsapp/share">
                                <img src="{{asset('media/logos/whatsapp.svg')}}" alt="" class="h-8">
                            </a>

                        </div>
                    </div>

                    <div class="pt-6 pb-12 px-4">
                        <p class="py-4"> {{\Carbon\Carbon::parse($post->created_at)->format('d-m-y')}}</p>
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
            <section class="p-2 w-full my-4 ">
                <div class="mx-auto bg-gray-700 p-2">
                    <h1 class="mb-6 text-2xl font-semibold tracking-tighter text-white sm:text-3xl title-font text-center">
                        @lang('main.Leave a comment')
                    </h1>
                    <form action="{{route('comment.store')}}" method="post" class="grid w-full md:w-1/2 mx-auto">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="flex flex-wrap w-full">
                            <input type="text" name="name" class="hidden">
                            <input type="text" name="name2" class="w-full md:w-1/2" placeholder="name">
                            <input type="email" name="email" class="hidden">
                            <input type="email" name="email2" class="w-full md:w-1/2" placeholder="email">
                        </div>
                        <div class=" grid w-full">
                            <textarea type="text" name="text" class=""></textarea>
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-700 text-white rounded my-4">@lang('main.Send')</button>

                        </div>
                    </form>
                </div>

            </section>
            @if($post->ActiveComments->count()===0)
            <h1 class="mb-6 text-2xl font-semibold tracking-tighter text-blue-800 sm:text-3xl title-font">
                @lang('main.No_comments')
            </h1>
            @else
            <section class="p-2 w-full my-4 ">


                <div class="p-2 bg-gray-700 text-white rounded">
                    <h1 class="mb-6 text-xl font-semibold tracking-tighter text-white  sm:text-3xl title-font">
                        @lang('main.Comments')
                    </h1>
                    <hr style="margin:5px">
                    <hr style="margin:5px">
                    @foreach($post->ActiveComments as $com)
                    @if ($com->visible)
                    <div class="border-b-2  border-white p-2">
                        <div class="flex justify-between">
                            <p>{{$com->name}}</p>
                            <p>{{\Carbon\Carbon::parse($com->created_at)->format('d-m-y')}}</p>
                        </div>
                        <div class="p-4">
                            <p>{{$com->comment}}</p>
                            @admin
                            <form action="{{route('comment.delete',$com->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" submi bg-red-500 p-2 rounded text-white float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4"
                                        stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                            @endadmin
                        </div>
                    </div>

                    @endif

                    @endforeach
                </div>

            </section>
            @endif
        </div>
        @include('guest.includes.relatedcontent')
    </div>

    @push('js')
    <script>

    </script>
    @endpush

</x-news-layout>
