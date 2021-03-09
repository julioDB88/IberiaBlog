<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="p-4 flex flex-wrap">



        <div class="w-full md:w-3/4 p-4 border-2 text-white bg-gray-700">

            <h1 class="tracking-widest font-bold text-3xl border-b-4 border-blue-700 ">
                @lang('main.Last Posts')
                <div class="float-right"><a href="{{route('posts.create')}}" class="btn btn-success text-white text-md"
                        style="position: relative;bottom:5px;">@lang('main.post_create')</a></div>
            </h1>

            <div class="my-3" style="max-height: 600px; overflow-y:auto">
                <table id="datatable"
                    class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="border-b-2 text-black">
                            <th class="py-3"> @lang('main.Date')</th>
                            <th> @lang('main.Title')</th>
                            <th> @lang('main.Edit')</th>
                            <th> @lang('main.Trash')</th>
                            <th> @lang('main.Stats')</th>
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
                <div style="max-height: 600px; overflow-y:auto">
                    <table class="bg-white rounded table-auto w-full border border-gray-700">
                        <thead class="w-full text-gray-700">
                            <tr>
                                <th class="py-2">@lang('main.Title')</th>
                                <th class="py-2">@lang('main.Comments')</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-300 w-full text-gray-700 text-center">
                            @foreach ($most_commented as $most)
                            <tr>

                                <td class=""> <a href="{{route('news.show',$most->slug)}}" class="text-sm">{{$most->title}}</a></td>
                                <td class="">{{$most->Comments->count()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>




    </div>



    @push('js')

    <script>
        $(function() {



            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('posts.index')}}',
                columns: [

                    { data: 'created_at', name: 'created_at',render:function(d,t,r,m){
                        return new Date(d).toLocaleDateString()
                    } },
                    { data: 'title', name: 'title' },
                    { data: 'id', name: 'id',render:function(d,t,r,m){
                       return "<a href='/admin/posts/"+d+"/edit' class='bg-yellow-500 rounded text-white px-4 py-2'><i class='fas fa-edit'></i></a>"
                    } },

                    { data: 'id', name: 'id',render:function(d,t,r,m){
                       return "<button class='bg-red-500 rounded text-white px-4 py-2 deleter' data-id='"+d+"'><i class='fas fa-trash'></i></button>"
                    } },
                    { data: 'comments_count', name: 'comments_count',render:function(d,t,r,m){

                        return  '<i class="far fa-comment-alt"></i>  ' +d;


                    } },

                ],
                initComplete: function () {
                    $('.deleter').on('click',function(){
                    $.ajax({
                    type: "DELETE",
                    url: "/api/posts/delete/"+$(this).attr('data-id'),

                    success: function (response) {
                    console.log(response)
                    }
                });

            })

                }
            });




        });


    </script>


    @endpush

</x-app-layout>
