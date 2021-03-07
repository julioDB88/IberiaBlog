<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Settings')
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div
                class=" px-8 py-2 mx-auto my-2 font-semibold  transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-indigo-700 text-center text-white">
                {!! session('success')!!}
            </div>
            @endif
            @if($errors->any())
            <div class="p-3 w-full mb-3 rounded text-red-500 font-bold">
                @foreach ($errors->all() as $error)
                <p>{{$error}} </p>
                @endforeach
            </div>
            @endif
            <section class=" ">
                @admin

                <div class="flex flex-wrap my-2 bg-gray-700 text-white">
                    <div class="p-3 w-full md:w-1/2 ">
                        <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 p-2 font-semibold">
                            @lang('main.Change_Logo')</h3>
                        <form action="{{route('changeLogo')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="file" name="logo" id="logo_file" class="rounded text-xs md:text-base m-2 p-2">
                            <button type="submit"
                                class="submi bg-blue-700 text-white px-4 py-2 rounded font-bold">@lang('main.Save')</button>

                        </form>

                    </div>
                    <div class="p-3 w-full md:w-1/2">
                        <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 p-2 font-bold">
                            @lang('main.Change_Video')</h3>
                        <form action="{{route('changeVideo')}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="file" name="video" id="vid_file" class="rounded text-xs md:text-base m-2 p-2">
                            <button type="submit"
                                class="submi bg-blue-700 text-white px-4 py-2 rounded font-bold">@lang('main.Save')</button>
                        </form>


                    </div>
                </div>
                @endadmin
            </section>

            <section class=" ">
                @admin

                <div class="flex flex-wrap my-2 bg-gray-700 text-white w-full">
                    <div class="p-3 w-1/2  ">
                        <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 p-2 font-semibold">
                            @lang('main.Activate_sections')</h3>
                            <div class="flex flex-col p-4">

                                @foreach ($sections as $section)

                                @livewire('activate-section', ['section' => $section], key($section->id))

                                @endforeach


                            </div>
                    </div>


                    <div class="p-3 w-1/2">
                        <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 p-2 font-semibold">
                            @lang('main.All_social')</h3>
                            <div class="p-2 flex flex-col">
                        @foreach ($social as $social)

                          @livewire('activate-rrss', ['social' => $social],   key($social->id))

                        @endforeach
                            </div>
                    </div>



                </div>
                @endadmin
            </section>
            <section class="bg-gray-700 text-white">
                <div class="rounded ">
                    <div class="flex flex-wrap rounded">
                        <div class="lg:w-2/4 p-2 w-full">
                            <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 p-2 font-semibold ">
                                @lang('main.Post Categories')</h3>
                            <form action="{{route('categories.store')}}" method="post" class="py-4 flex">
                                @csrf
                                <input type="text" name="name" class="rounded w-full text-black"
                                    placeholder="@lang('main.New Post Category')">
                                <button
                                    class="px-6 bg-blue-700 py-2 border-gray-600 border-2 text-white-800 rounded font-bold">
                                    @lang('main.Add')
                                </button>
                            </form>
                            <table class="w-full border table-auto bg-white rounded">
                                <thead class="bg-blue-700 text-white border-2">
                                    <tr>
                                        <th class="py-2">@lang('main.Name')</th>
                                        <th>@lang('main.Posts')</th>
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
                                                <button type="submit"
                                                    class="border border-indigo-700 border-4 px-4 py-1 rounded hover:bg-indigo-700 hover:text-white"><i
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
                        <div class="lg:w-2/4 p-2 w-full">
                            <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 p-2 font-semibold ">
                                @lang("main.Social_Urls")</h3>
                            <h3 class="text-xl font-semibold border-b-2  p-2 my-2 text-center">
                                @lang("main.New_social")</h3>
                            <form action="{{route('social.store')}}" method="post" class="pb-4"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-wrap">
                                    <input type="text" name="name" class="w-full md:w-1/3 rounded my-1 text-black"
                                        placeholder="@lang('main.Name')">
                                    <input type="url" name="url" class="rounded w-full md:w-1/3 my-1 text-black"
                                        placeholder="@lang('main.Url')">

                                    <div class="my-2 flex items-center w-1/2 md:w-1/3 px-2 ">
                                        <label for="icon" class=" mr-4">@lang('main.Icon_image')</label>
                                        <label for="icon"
                                            class="cursor-pointer px-2 py-1 border border-indigo-700 hover:bg-indigo-700 hover:text-white  rounded">
                                            <i class="fas fa-file"></i>
                                            <input type="file" name="icon" id="icon" class="hidden"
                                                placeholder="@lang('main.Social_Icon')">
                                        </label>
                                    </div>
                                </div>

                                <button
                                    class=" w-full border border-indigo-700 bg-blue-700 hover:bg-indigo-500 text-white   px-4 p-2 m-1 rounded">
                                    @lang('main.Add')
                                </button>
                            </form>

                        </div>

                        </div>
                        @endadmin
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
