<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <section class="text-gray-700 body-font">
                <div class="container  md:px-4">
                    <div class="flex flex-wrap ">
                        <div class=" mx-auto lg:w-2/4 md:w-full">
                            <div class="h-full p-6 border rounded-xl">

                                <h3 class="tracking-widest">Posts</h3>

                                <p class="mb-4 text-base leading-relaxed">Top 10 comented</p>
                                <p class="mb-4 text-base leading-relaxed">last 5 posts</p>


                            </div>
                        </div>
                        <div class=" mx-auto lg:w-2/4 md:w-full">
                            <div class="h-full p-6 border rounded-xl">

                                <h3 class="tracking-widest">{{__('Categories')}}</h3>

                               <form action="{{route('categories.create')}}" method="post">
                                @csrf
                                <input type="text" name="name" class="rounded w-full">
                                <button
                                    class="items-end w-full bg-gray-100 hover:bg-blue-500 py-4 border-blue-500 border-2 my-4 text-gray-800 hover:text-white rounded">
                                    {{__('Add')}}
                                </button>
                                </form>
                                <table class="w-full border table-auto">
                                    <thead>
                                        <tr>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Edit')}}</th>
                                            <th>{{__('Posts')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cats as $cat)
                                        <tr class="text-center">
                                            <td class="py-4">{{$cat->name}}</td>
                                            <td class="py-4"> <a href="{{route('categories.edit',$cat->id)}}" class="bg-yellow-600 px-4 py-2 rounded text-white"><i class="fas fa-edit"></i></a></td>
                                            <td class="py-4">{{$cat->Posts->count()}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>



                            </div>
                        </div>

                    </div>
                </div>
            </section>



        </div>
    </div>
</x-app-layout>
