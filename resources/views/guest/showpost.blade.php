@push('meta')
    <meta name="description" content="{{$post->description}}"/>
    <meta name="keywords" content="{{$post->keywords}}"/>
    <title>{{config('app.name')}} | {{$post->title}}</title>
@endpush
<style>
   .tinymce > p,h3,h1,h2,h4,h5{
        margin:4px !important;
        padding:4px !important;

    }
    img{
        margin: 15px !important;
    }
    .logo{
        margin: auto !important;
    }
</style>
<x-news-layout>


 <section class="block " >
            <div class="container flex flex-col items-center justify-center px-10 pt-8 mx-auto lg:px-32 h-48">
                <img class="object-cover object-center mx-auto mb-10 rounded-lg lg:w-full md:w-15/5 w-20/6 h-full" alt="{{config('app.name')}} | {{$post->title}}"
                    src="{{asset('storage/posts')}}/{{$post->img_file}}">
            </div>
        </section>
        <section class="text-gray-700 body-font">
            <div class="container px-8 pt-2 pb-2 mx-auto lg:px-4">
                <div class="flex flex-col w-full mb-12 text-left lg:text-center">

                    <h1 class="mb-6 text-2xl font-semibold tracking-tighter text-blue-800 sm:text-3xl title-font">
                      {{$post->title}}
                    </h1>
                    <div class="flex w-full justify-between">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" target="_blank">
                            Share on Facebook
                          </a>
                        <a href="whatsapp://send?text={{Request::url()}}" data-action="share/whatsapp/share">Share via Whatsapp</a>

                    </div>
                 </div>
                <div class="tinymce">
                    {!! $post->content !!}
                </div>
            </div>
        </section>


</x-news-layout>
