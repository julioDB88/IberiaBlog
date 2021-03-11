<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="p-1 md:p-4 flex flex-wrap">
        <div class="w-full md:w-3/4 p-4 border-2 text-white bg-gray-700">

            <h1 class="tracking-widest font-bold text-base md:text-3xl border-b-4 border-blue-700 ">
                @lang('main.Last Posts')
                <div class="float-right"><a href="{{route('posts.create')}}"
                        class="rounded px-2 py-1 bg-indigo-500 text-white text-sm md:text-md"
                        style="position: relative;bottom:5px;">@lang('main.post_create')</a></div>
            </h1>

            <div class="my-3 post-dt">
                <table id="posts-datatable"
                    class=" border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="border-b-2 text-black">
                            <th class=""> @lang('main.Date')</th>
                            <th> @lang('main.Title')</th>
                            <th> @lang('main.Edit')</th>
                            <th> @lang('main.Trash')</th>
                            <th> @lang('main.Comments')</th>
                            <th> @lang('main.Status')</th>
                        </tr>
                    </thead>

                    <tbody class="bg-gray-300 text-gray-700">

                    </tbody>


                </table>
            </div>

        </div>
        <div class="md:w-1/4 p-2 w-full text-white bg-gray-500">
            <div class="h-full p-2 ">

                <p class="mb-4 text-base leading-relaxed my-4 font-xl font-semibold">@lang('main.Top_10_comented')</p>
                <div>
                    <table class="bg-white rounded table-auto w-full border border-gray-700 text-center striped">
                        <thead class="w-full text-gray-700">
                            <tr>
                                <th class="py-2">@lang('main.Title')</th>
                                <th>@lang('main.Author')</th>
                                <th class="py-2"><i class="far fa-comment-alt"></i> </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-300 w-full text-gray-700 text-center">
                            @foreach ($most_commented as $most)
                            <tr>

                                <td class="py-2"> <a href="{{route('news.show',$most->slug)}}"
                                        class="text-sm">{{$most->title}}</a></td>
                                <td>{{$most->Author->name}}</td>
                                <td class="">{{$most->Comments->count()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="p-4 border-2 text-white bg-gray-700 ">
        <h1 class="tracking-widest font-bold text-base md:text-3xl border-b-4 border-blue-700 ">
            @lang('main.Next_posts')</h1>

        <div class="my-3 post-dt">

            <table id="nextposts-datatable"
                class=" border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="border-b-2 text-black">
                        <th class=""> @lang('main.Date')</th>
                        <th> @lang('main.Title')</th>
                        <th> @lang('main.Edit')</th>
                        <th> @lang('main.Trash')</th>
                        <th> @lang('main.Status')</th>
                    </tr>
                </thead>

                <tbody class="bg-gray-300 text-gray-700">

                </tbody>


            </table>
        </div>
    </div>

</x-app-layout>
