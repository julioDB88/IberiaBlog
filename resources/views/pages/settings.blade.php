<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div
                class=" px-8 py-2 mx-auto my-2 font-semibold text-white transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-indigo-700 text-center">
                {!! session('success')!!}
            </div>
            @endif
            @if($errors->any())
            <div class="bg-red-500 p-3 w-full mb-3 rounded">
                @foreach ($errors->all() as $error)
                <p class=text-white">{{$error}} </p>
                @endforeach
            </div>
            @endif
            <section class="container">
                <div class="rounded border-white bg-gray-700">
                    <div class="flex flex-wrap">
                        <div class="lg:w-2/4 p-2 w-full p-6 ">
                            <h3 class="tracking-widest text-lg border-b-4 border-white text-white">
                                {{__('Post Categories')}}</h3>
                            <form action="{{route('categories.store')}}" method="post" class="py-4 flex">
                                @csrf
                                <input type="text" name="name" class="rounded w-full"
                                    placeholder="{{__('New Post Category')}}">
                                <button
                                    class="px-6 bg-white py-2 border-gray-600 border-2 text-gray-800 rounded font-bold">
                                    {{__('Add')}}
                                </button>
                            </form>
                            <table class="w-full border table-auto bg-white rounded">
                                <thead>
                                    <tr>
                                        <th class="py-2">{{__('Name')}}</th>
                                        <th>{{__('Posts')}}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $cat)
                                    <tr class="text-center">
                                        <td class="py-4">{{$cat->name}}</td>
                                        <td class="py-4">{{$cat->Posts->count()}}</td>
                                        <td>
                                            @if(!$cat->Posts->count())
                                            <form action="{{route('categories.destroy',$cat->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 px-4 py-1 rounded"><i
                                                        class="fas fa-trash text-white"></i></button>

                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @admin
                        <div class="lg:w-2/4 p-2 w-full p-6  ">
                            <h3 class="tracking-widest text-lg border-b-4 border-white text-white">
                                {{__("Social Url's")}}</h3>
                            <h3 class="text-base text-white p-2">
                                {{__("New_social")}}</h3>
                            <form action="{{route('social.store')}}" method="post" class="pb-4"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                    <input type="text" name="name" class="rounded " placeholder="{{__('Name')}}">
                                    <input type="url" name="url" class="rounded" placeholder="{{__('Url')}}">
                                    <div class="my-2 flex items-center">
                                        <label for="icon" class="text-white mr-4">{{__('Icon_image')}}</label>
                                        <label for="icon" class="px-2 py-1 bg-indigo-500 text-white"> <i
                                                class="fas fa-file"></i>
                                            <input type="file" name="icon" id="icon" class="hidden"
                                                placeholder="{{__('Social_Icon')}}"></label>
                                    </div>
                                </div>




                                <button
                                    class="px-6 bg-white py-2 border-gray-600 border-2 text-gray-800 w-full rounded font-bold">
                                    {{__('Add')}}
                                </button>
                            </form>
                            <h3 class="text-base text-white p-2">
                                {{__("All_social")}}</h3>

                            @foreach ($social as $item)
                            <form action="{{route('social.update',$item->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="p-2">
                                    <div class="grid grid-cols-5 items-center gap-2">
                                        <input type="text" name="name" class="rounded focus:ring-green-300"
                                            value="{{$item->name}}">
                                        <input type="text" name="url" class="rounded focus:ring-green-300"
                                            value="{{$item->url}}">
                                        <label for="icon" class="mx-auto"> <i
                                                class="fas fa-file px-2 py-1 bg-indigo-500 text-white rounded"></i>
                                            <input type="file" name="icon" id="icon" class="hidden"
                                                placeholder="{{__('Social_Icon')}}"></label>
                                        <label for="" class="flex items-center p-2 text-white">
                                            <input type="checkbox" name="active" @if($item->active) checked @endif
                                            class="mr-2">Active
                                        </label>

                                        <button type="submit"
                                            class="bg-indigo-500  px-4 p-2 w-full text-white">{{__('Save')}}</button>
                                    </div>
                                </div>
                            </form>
                            @endforeach


                        </div>
                        @endadmin
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
