<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.Invitations')
        </h2>
    </x-slot>
    <div class="p-5 flex flex-wrap">

        <div class="w-full md:w-1/2 bg-gray-700">
            <div class="p-6">
                <h2 class="mb-3  border-b-2 border-blue-700 text-lg font-bold text-white lg:text-4xl title-font">
                    @lang('main.Pending Invitations')
                </h2>
                <table class="w-full bg-white rounded-t py-2">
                    <thead class="">
                        <tr>
                            <th class="py-2">@lang('main.Invited')</th>
                            <th>@lang('main.password')</th>
                            <th>@lang('main.Date')</th>
                            <th>@lang('main.Remove')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invits as $invi)
                        <tr>

                                <td class="p-2">{{$invi->email}}</td>
                                <td class="p-2">{{$invi->password}}</td>
                                <td class="p-2">{{Carbon\Carbon::parse($invi->created_at)->format('d-m-y')}}</td>
                                <td class="p-2">
                                    <form action="{{route('invitation.destroy',$invi->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="invi-button px-4 py-2 rounded bg-red-500 text-white">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="w-full md:w-1/2">
            <div class="bg-gray-700 text-white">

                <form action="{{route('invitation.store')}}" method="post" class="p-6">
                    @csrf

                    <h2
                        class="mb-3  border-b-2 border-blue-700 text-lg font-semibold text-white lg:text-4xl title-font">
                        @lang('main.Send_Invitation')
                    </h2>
                    <div class="flex flex-col w-full mx-auto mt-10 rounded-lg md:ml-auto md:mt-0">
                        <div class="relative ">
                            <input type="email" id="email" name="email" placeholder="email"
                                class="w-full px-4 py-2 mb-4 mr-4 text-base text-blue-700 bg-gray-100 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0">
                        </div>
                        <div class="relative ">
                            <input type="password" id="password" name="password" placeholder="password"
                                class="w-full px-4 py-2 mb-4 mr-4 text-base text-blue-700 bg-gray-100 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0">
                        </div>
                        <button
                            class="px-8 py-2 font-semibold text-white transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-gradient-to-r from-blue-700 hover:from-blue-600 to-blue-600 hover:to-blue-700 focus:ring focus:outline-none">@lang('main.Send')</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<script>

</script>
