<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if(session('success'))
                <div class="w-1/2 px-8 py-2 mx-auto my-2 font-semibold text-white transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-indigo-700">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="container">
                <div class="rounded border-white bg-gray-700">
                    <div class="flex flex-wrap">
                        <div class="lg:w-2/4 p-2 w-full p-6 ">
                            <h3 class="tracking-widest text-lg border-b-4 border-gray-600 text-white">{{__('Categories')}}</h3>
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
                        @admin
                        <div class="lg:w-2/4 p-2 w-full p-6  ">
                            <h3 class="tracking-widest text-lg border-b-4 border-gray-600 text-white">{{__("Social Url's")}}</h3>
                            <form action="{{route('rrss.update')}}" method="post">
                                @csrf
                                @method('PUT')
                                @foreach ($social as $item)
                                <div class="grid  p-2">
                                    <label for="" class="text-white">{{$item->name}}</label>
                                    <input type="text" name="{{$item->name}}" class="rounded focus:ring-green-300" @if($item->url != 'none' ) value="{{$item->url}}" @endif>
                                    <label for="" class="flex items-center p-2 text-white">
                                        <input type="checkbox" name="{{$item->name}}_c" @if($item->active) checked @endif
                                            class="mr-2">Active</label>
                                </div>
                                @endforeach
                                <button type="submit" class="bg-indigo-500  px-4 p-2 w-full">{{__('Save')}}</button>
                            </form>

                        </div>
                        @endadmin
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
