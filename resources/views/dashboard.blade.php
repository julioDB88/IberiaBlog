<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.Dashboard')
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
            <div class="bg-red-500 p-3 w-full mx-auto text-white rounded">
                @foreach ($errors->all() as $error)
                <p class=text-white">{{$error}} </p>
                @endforeach
            </div>
            @endif

            <section class="body-font">
                <div class="container">
                    <div class="rounded bg-gray-700 text-white ">
                        <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 mx-2 p-2 font-bold">@lang('main.Posts')</h3>
                        <div class="flex flex-wrap">



                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
    @push('js')
    <script>
        $(function(){
        $('.submi').on('click',function(){
            $(this).css('display','none').click()

        })
    ;})
    </script>
    @endpush
</x-app-layout>
