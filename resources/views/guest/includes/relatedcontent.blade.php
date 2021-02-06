<div class="hidden md:w-1/5 md:block pt-16 text-center">
    <div class="p-3">{{__('Related Posts')}}</div>
    <div class="p-3 grid ">
        @foreach ($related as $rel)
        <div class="m-3 pb-3 border">
            <a href="{{route('news.show',$rel->slug)}}">
                <img src="{{asset('storage/posts')}}/{{$rel->img_file}}" alt="{{config('app.name')}} - {{$rel->description}}" class="w-full pb-3 ">
                <p>{{$rel->title}}</p>
            </a>

        </div>
        @endforeach




    </div>
</div>
