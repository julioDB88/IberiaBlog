<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.Dashboard')
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
            <div class="bg-red-500 p-3 w-full mx-auto text-white rounded">
                @foreach ($errors->all() as $error)
                <p class=text-white">{{$error}} </p>
                @endforeach
            </div>
            @endif

            <section class="body-font">
                <div class="container">
                    <div class="rounded bg-gray-700 text-white ">
                        <h3 class="tracking-widest text-2xl border-b-4 border-blue-700 mx-2 p-2 font-bold">@lang('main.Dashboard')</h3>
                        <div class="p-4 border-2 text-white bg-gray-700 ">


                            <div class="my-3 post-dt">

                                <table id="users-datatable"
                                    class=" border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                                    <thead>
                                        <tr class="border-b-2 text-black">
                                            <th class=""> @lang('User')</th>
                                            <th> @lang('main.Posts')</th>
                                            <th> @lang('main.Trash')</th>
                                            <th> @lang('main.Status')</th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-gray-300 text-gray-700">
                                        @php $users= User::all() @endphp
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{$user->name}}</td>
                                                    <td> @if ($user->Posts)
                                                      {{  $user->Posts->count()}}
                                                    @else
                                                        0
                                                    @endif</td>
                                                    <td><a href="#" class="btn btn-danger active" role="button">Remove</a></td>
                                                    <td>@if ($user->email_verified_at)
                                                        Verificado
                                                    @else
                                                        Sin verificar
                                                    @endif</td>

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
    @push('js')


    @endpush
</x-app-layout>
