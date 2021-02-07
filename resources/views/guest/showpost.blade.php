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
        <section class="container px-8 pt-2 pb-2 mx-auto lg:px-4">
            <h1 class="mb-6 text-2xl font-semibold tracking-tighter text-blue-800 sm:text-3xl title-font">
                {{__('Leave a comment')}}
              </h1>
            <form action="{{route('comment.store')}}" method="post" class="grid">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="flex flex-wrap w-full md:w-1/2">
                    <input type="text" name="name" class="hidden">
                    <input type="text" name="name2" class="w-full md:w-1/2" placeholder="name">
                    <input type="email" name="email" class="hidden">
                    <input type="email" name="email2" class="w-full md:w-1/2" placeholder="email">
                </div>
            <div class=" grid w-full md:w-1/2 ">
                <textarea type="text" name="text" class="" ></textarea>
                <button type="submit" class="px-4 py-2 bg-indigo-700 text-white rounded my-4">{{__('Send')}}</button>

            </div>
            </form>
        </section>
        <section class="container px-8 pt-2 pb-2 mx-auto lg:px-4">
            @if(count($comments)==0)
            <h1 class="mb-6 text-2xl font-semibold tracking-tighter text-blue-800 sm:text-3xl title-font">
                {{__('No comments yet')}}
              </h1>
            @else
            <div class="p-2">
                @foreach($comments as $com)
                    @if ($com->visible)
                    <div class="border-b-2 w-full md:w-1/2 bg-gray-300 border-indigo-500 p-2">
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
                                <button type="submit"
                                class=" submi bg-red-500 p-2 rounded text-white float-right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                              </button>
                            </form>
                            @endadmin
                        </div>
                    </div>

                    @endif

                @endforeach
            </div>
            @endif
        </section>
@push('js')
    <script>

    </script>
@endpush

</x-news-layout>
