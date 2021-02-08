<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
            <section class=" ">
                @admin

                <div class="flex flex-wrap my-2 bg-white text-indigo-700 ">
                    <div class="p-3 w-full md:w-1/2 ">
                        <h3 class="tracking-widest text-lg border-b-4 border-indigo-700 p-2 font-semibold">{{__('Change_Logo')}}</h3>
                        <form action="{{route('changeLogo')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="file" name="logo" id="logo_file" class="rounded text-xs md:text-base m-2 p-2">
                            <button type="submit"
                                class="submi bg-gray-700 text-white px-4 py-2 rounded font-bold">{{__('Save')}}</button>

                        </form>

                    </div>
                    <div class="p-3 w-full md:w-1/2">
                        <h3 class="tracking-widest text-lg border-b-4 border-indigo-700 p-2 font-bold">{{__('Change_Video')}}</h3>
                        <form action="{{route('changeVideo')}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="file" name="video" id="vid_file" class="rounded text-xs md:text-base m-2 p-2">
                            <button type="submit"
                                class="submi bg-gray-700 text-white px-4 py-2 rounded font-bold">{{__('Save')}}</button>
                        </form>


                    </div>
                </div>
                @endadmin
            </section>
            <section class="body-font">
                <div class="container">
                    <div class="rounded border bg-gray-700 text-white    ">
                        <h3 class="tracking-widest text-lg border-b-4 border-white mx-2 p-2 font-xl font-semibold">{{__('Posts')}}</h3>
                        <div class="flex flex-wrap">
                            <div class="lg:w-2/4 p-2 w-full">
                                <div class="h-full p-6 ">

                                    <p class="mb-4 text-base leading-relaxed my-4 font-xl font-semibold">{{__('Top_10_comented')}}</p>
                                    <div style="max-height: 600px; overflow-y:auto">
                                        <table class="bg-white rounded table-auto w-full border border-gray-700">
                                            <thead class="w-full text-gray-700">
                                                <tr>
                                                    <th class="py-2">{{__('Date')}}</th>
                                                    <th class="py-2">{{__('Title')}}</th>
                                                    <th class="py-2">{{__('Author')}}</th>
                                                    <th class="py-2">{{__('Comments')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-gray-300 w-full text-gray-700 text-center">
                                                @foreach ($most_commented as $most)
                                                <tr>
                                                    <td class="p-3 m-3">
                                                        {{\Carbon\Carbon::parse($most->created_at)->format('d/m/y')}}
                                                    </td>
                                                    <td class="p-3 m-3">{{$most->title}}</td>
                                                    <td class="p-3 m-3">{{$most->Author->name}}</td>
                                                    <td class="p-3 m-3">{{$most->Comments->count()}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="lg:w-2/4 p-2 w-full">
                                <div class="h-full p-6 ">
                                    <p class="mb-4 text-base leading-relaxed my-4">{{__('Last_10_posts')}}</p>
                                    <div style="max-height: 600px; overflow-y:auto">
                                        <table class="bg-white rounded table-auto w-full border border-gray-700">
                                            <thead class="w-full text-gray-700">
                                                <tr>
                                                    <th class="py-2">{{__('Date')}}</th>
                                                    <th class="py-2">{{__('Title')}}</th>
                                                    <th class="py-2">{{__('Author')}}</th>
                                                    <th class="py-2">{{__('Comments')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-gray-300 w-full text-gray-700 text-center">
                                                @foreach ($last_posts as $post)
                                                <tr>
                                                    <td class="p-3 m-3">
                                                        {{\Carbon\Carbon::parse($post->created_at)->format('d/m/y')}}
                                                    </td>
                                                    <td class="p-3 m-3">{{$post->title}}</td>
                                                    <td class="p-3 m-3">{{$post->Author->name}}</td>
                                                    <td class="p-3 m-3">{{$post->Comments->count()}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
