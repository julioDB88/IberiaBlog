<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
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

                    </div>
                </div>
            </section>
            <section class="container">
                <div class="rounded border-white bg-green-400">
                    <div class="flex flex-wrap">
                        <div class="lg:w-2/4 p-2 w-full p-6 ">
                            <h3 class="tracking-widest text-lg border-b-4 border-gray-600">{{__('Categories')}}</h3>
                            <form action="{{route('categories.store')}}" method="post" class="py-4">
                                @csrf
                                <input type="text" name="name" class="rounded w-full">
                                <button
                                    class="items-end w-full bg-gray-100 py-2 border-gray-600 border-2 my-4 text-gray-800 rounded font-bold">
                                    {{__('Add')}}
                                </button>
                            </form>
                            <table class="w-full border table-auto bg-white rounded">
                                <thead>
                                    <tr>
                                        <th class="py-2">{{__('Name')}}</th>
                                        <th>{{__('Posts')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $cat)
                                    <tr class="text-center">
                                        <td class="py-4">{{$cat->name}}</td>
                                        <td class="py-4">{{$cat->Posts->count()}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="lg:w-2/4 p-2 w-full p-6  ">
                            <h3 class="tracking-widest text-lg border-b-4 border-gray-600">{{__("Social Url's")}}</h3>
                            <form action="{{route('rrss.update')}}" method="post">
                                @csrf
                                <div class="grid  p-2">
                                    <label for="" class="text-white">Twitter</label><input type="text" name="twitter">
                                    <label for="" class="flex items-center p-2"><input type="checkbox" name="twitter_c" class="mr-2">Active</label>
                                </div>
                                <div class="grid p-2">
                                    <label for="" class="text-white">Instagram</label><input type="text" name="instagram">
                                    <label for="" class=" flex items-center p-2"><input type="checkbox" name="instagram_c" class="mr-2">Active</label>
                                </div>
                                <div class="grid  p-2">
                                    <label for="" class="text-white">Facebook</label><input type="text" name="facebook" >
                                    <label for="" class="flex items-center p-2"><input type="checkbox" name="facebook_c" class="mr-2" >Active</label>
                                </div>
                                <div class="grid  p-2">
                                    <label for="" class="text-white">Youtube</label><input type="text" name="youtube">
                                    <label for="" class="flex items-center p-2"><input type="checkbox" name="youtube_c" class="mr-2">Active</label>
                                </div>
                                <button type="submit" class="bg-indigo-500 text-white px-4 p-2 w-full">{{__('Save')}}</button>
                            </form>

                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
</x-app-layout>
