<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    <label for="" class="flex items-center p-2"><input type="checkbox" name="twitter_c"
                                            class="mr-2">Active</label>
                                </div>
                                <div class="grid p-2">
                                    <label for="" class="text-white">Instagram</label><input type="text"
                                        name="instagram">
                                    <label for="" class=" flex items-center p-2"><input type="checkbox"
                                            name="instagram_c" class="mr-2">Active</label>
                                </div>
                                <div class="grid  p-2">
                                    <label for="" class="text-white">Facebook</label><input type="text" name="facebook">
                                    <label for="" class="flex items-center p-2"><input type="checkbox" name="facebook_c"
                                            class="mr-2">Active</label>
                                </div>
                                <div class="grid  p-2">
                                    <label for="" class="text-white">Youtube</label><input type="text" name="youtube">
                                    <label for="" class="flex items-center p-2"><input type="checkbox" name="youtube_c"
                                            class="mr-2">Active</label>
                                </div>
                                <button type="submit"
                                    class="bg-indigo-500 text-white px-4 p-2 w-full">{{__('Save')}}</button>
                            </form>

                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
</x-app-layout>
