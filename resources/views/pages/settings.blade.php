<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div  class=" px-8 py-2 mx-auto my-2 font-semibold  transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-indigo-700 text-center text-white">
                {!! session('success')!!}
            </div>
            @endif
            @if($errors->any())
            <div class="p-3 w-full mb-3 rounded text-red-500 font-bold">
                @foreach ($errors->all() as $error)
                <p >{{$error}} </p>
                @endforeach
            </div>
            @endif
            <section class="container bg-gray-700 text-white">
                <div class="rounded border-blue-500 ">
                    <div class="flex flex-wrap border-2 border-indigo-700 rounded">
                        <div class="lg:w-2/4 p-2 w-full p-6 ">
                            <h3 class="tracking-widest font-bold text-3xl border-b-4 border-blue-700 ">
                                {{__('Post Categories')}}</h3>
                            <form action="{{route('categories.store')}}" method="post" class="py-4 flex">
                                @csrf
                                <input type="text" name="name" class="rounded w-full"
                                    placeholder="{{__('New Post Category')}}">
                                <button
                                    class="px-6 bg-blue-700 py-2 border-gray-600 border-2 text-white-800 rounded font-bold">
                                    {{__('Add')}}
                                </button>
                            </form>
                            <table class="w-full border table-auto bg-white rounded">
                                <thead class="bg-blue-700 text-white border-2">
                                    <tr>
                                        <th class="py-2">{{__('Name')}}</th>
                                        <th>{{__('Posts')}}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $cat)
                                    <tr class="text-center text-black">
                                        <td class="py-4">{{$cat->name}}</td>
                                        <td class="py-4">{{$cat->Posts->count()}}</td>
                                        <td>
                                            @if(!$cat->Posts->count())
                                            <form action="{{route('categories.destroy',$cat->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border border-indigo-700 border-4 px-4 py-1 rounded hover:bg-indigo-700 hover:text-white"><i
                                                        class="fas fa-trash "></i></button>

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
                            <h3 class="tracking-widest font-bold text-3xl border-b-4 border-blue-700 ">
                                {{__("Social Url's")}}</h3>
                            <h3 class="text-xl font-semibold border-b-2  p-2 my-2 text-center">
                                {{__("New_social")}}</h3>
                            <form action="{{route('social.store')}}" method="post" class="pb-4"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-wrap">
                                    <input type="text" name="name" class="w-full md:w-1/3 rounded my-1 text-black"
                                        placeholder="{{__('Name')}}">
                                    <input type="url" name="url" class="rounded w-full md:w-1/3 my-1 text-black"
                                        placeholder="{{__('Url')}}">

                                    <div class="my-2 flex items-center w-1/2 md:w-1/3 px-2 ">
                                        <label for="icon" class=" mr-4">{{__('Icon_image')}}</label>
                                        <label for="icon" class="cursor-pointer px-2 py-1 border border-indigo-700 hover:bg-indigo-700 hover:text-white  rounded">
                                            <i class="fas fa-file"></i>
                                            <input type="file" name="icon" id="icon" class="hidden"
                                                placeholder="{{__('Social_Icon')}}">
                                        </label>
                                    </div>
                                </div>

                            <button class=" w-full border border-indigo-700 bg-blue-700 hover:bg-indigo-500 text-white   px-4 p-2 m-1 rounded">
                                {{__('Add')}}
                            </button>
                        </form>
                            <h3 class="text-xl font-semibold border-b-2  p-2 my-2 text-center">
                                {{__("All_social")}}</h3>

                            @foreach ($social as $item)

                            <div class="p-2 flex flex-wrap items-center">

                                <form action="{{route('social.update',$item->id)}}" method="post" class="flex flex-wrap w-full md:w-4/5"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                        <input type="text" name="name" class="text-black rounded focus:ring-green-300 w-full md:w-1/3"
                                            value="{{$item->name}}">
                                        <input type="text" name="url" class="rounded  text-black focus:ring-green-300 w-full md:w-1/3"
                                            value="{{$item->url}}">
                                        <div class="w-full md:w-1/3 flex justify-around">
                                            <label for="" class="flex items-center p-2 ">
                                                <input type="checkbox" name="active" @if($item->active) checked @endif
                                                class="mr-2">Active
                                            </label>

                                            <button type="submit"
                                                class=" border border-indigo-700  px-2 py-1   rounded hover:bg-indigo-700 hover:text-white">{{__('Save')}}</button>

                                        </div>

                                </form>
                                <form action="{{route('social.destroy',$item->id)}}" method="post" class="text-center w-full md:w-1/5">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="w-full md:w-min my-2 md:m-0"><i
                                            class="fas fa-trash  border border-red-500 rounded px-4 py-2 w-full"></i></button>
                                </form>

                            </div>

                            @endforeach


                        </div>
                        @endadmin
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
