<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.Comments')
        </h2>
    </x-slot>
    <div class="p-5">
        @if (Session::has('success'))
        <div class="alert-banner w-full">
            <input type="checkbox" class="hidden" id="banneralert">

            <label
                class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white"
                title="close" for="banneralert">
                {{ Session::get('success') }}
            </label>
        </div>

        @endif
        @if($errors->any())
        <div class="bg-red-500 p-3 w-full rounded">
            @foreach ($errors->all() as $error)
            <p class=text-white">{{$error}} </p>
            @endforeach
        </div>
        @endif
        <section class="body-font my-4">
            <div class="container mx-auto">
                <div class="rounded border-gray-700 border-2 bg-gray-700 text-white">
                    <h3 class="tracking-widest text-3xl border-b-2 border-blue-700 p-2 mx-2 font-bold ">
                        @lang('main.Comments')</h3>
                    <div class="px-2 my-4">
                        <table class="table-auto w-full" id="com-datatable">
                            <thead class="bg-blue-900 text-white">
                                <tr>
                                    <th></th>
                                    <th>@lang('main.Date')</th>
                                    <th>#</th>
                                    <th class="p-2">@lang('main.Name')</th>
                                    <th class="p-2">@lang('main.Email')</th>
                                    <th>@lang('main.Post')</th>
                                    <th>@lang('main.Status')</th>
                                    <th>@lang('main.Delete')</th>

                                </tr>
                            </thead>
                            <tbody class="text-black bg-white"></tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>
        </section>
        @push('js')
        <script>



        </script>
        @endpush
    </div>

</x-app-layout>
