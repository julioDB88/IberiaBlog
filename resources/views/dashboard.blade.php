<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if($errors->any())
    <div class="bg-red-500 p-3 w-full rounded">
        @foreach ($errors->all() as $error)
        <p class=text-white">{{$error}} </p>
        @endforeach
    </div>
    @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="text-gray-700 body-font">
                <div class="container">
                    <div class="rounded border-gray-100 bg-gray-700 text-white  ">
                        <h3 class="tracking-widest text-lg border-b-4 border-white p-2">{{__('Posts')}}</h3>
                        <div class="flex flex-wrap">
                            <div class="lg:w-2/4 p-2 w-full text-white">
                                <div class="h-full p-6 ">

                                    <p class="mb-4 text-base leading-relaxed my-4">{{__('Top_10_comented')}}</p>
                                    <table class="bg-white rounded table-auto w-full my-4 border border-green-400">
                                        <thead class="w-full text-gray-700">
                                            <tr>
                                                <th class="py-2">{{__('Date')}}</th>
                                                <th class="py-2">{{__('Title')}}</th>
                                                <th class="py-2">{{__('Comments')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-gray-300 w-full text-gray-700">
                                            @foreach ($most_commented as $most)
                                            <tr>
                                                <td class="p-3 m-3">
                                                    {{\Carbon\Carbon::parse($most->created_at)->format('d/m/y')}}</td>
                                                <td class="p-3 m-3">{{$most->title}}</td>
                                                <td class="p-3 m-3">{{$most->Comments->count()}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="lg:w-2/4 p-2 w-full">
                                <div class="h-full p-6 text-white ">
                                    <p class="mb-4 text-base leading-relaxed my-4">{{__('Last_10_posts')}}</p>

                                    <table class="bg-white rounded table-auto w-full my-4 border border-green-400">
                                        <thead class="w-full text-gray-700">
                                            <tr>
                                                <th class="py-2">{{__('Date')}}</th>
                                                <th class="py-2">{{__('Title')}}</th>
                                                <th class="py-2">{{__('Comments')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-gray-300 w-full text-gray-700">
                                            @foreach ($last_posts as $post)
                                            <tr>
                                                <td class="p-3 m-3">
                                                    {{\Carbon\Carbon::parse($most->created_at)->format('d/m/y')}}</td>
                                                <td class="p-3 m-3">{{$post->title}}</td>
                                                <td class="p-3 m-3">{{$post->Comments->count()}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="p-3 w-full md:w-1/2  bg-indigo-700 rounded ">
                                <h3 class="tracking-widest text-lg border-b-4 border-white p-2">{{__('Change_Logo')}}</h3>
                                <form action="{{route('changeLogo')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                <input type="file" name="logo" id="logo_file" class="rounded text-xs md:text-base m-2 p-2">
                                <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded font-bold">{{__('Save')}}</button>

                                </form>

                            </div>
                            <div class="p-3 w-full md:w-1/2   bg-indigo-700 rounded ">
                                <h3 class="tracking-widest text-lg border-b-4 border-white p-2">{{__('Change_Video')}}</h3>
                                <form action="{{route('changeVideo')}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <input type="file" name="video" id="vid_file" class="rounded text-xs md:text-base m-2 p-2">
                                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded font-bold">{{__('Save')}}</button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
