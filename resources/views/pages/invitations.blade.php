<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invitations') }}
        </h2>
    </x-slot>
    <div class="p-5 flex flex-wrap">

        <div class="w-full md:w-1/2">
            @foreach ($invits as $invi)
            <div class="flex justify-between content-between p-4 border-b2 border-green-600">
                <p>{{$invi->email}}</p>
                <p>{{$invi->password}}</p>
                <p>{{Carbon\Carbon::parse($invi->created_at)->format('d-m-y')}}</p>
                <p><button class="invi-button px-4 py-2 rounded bg-red-500" id="{{$invi->id}}"><i
                            class="fas fa-trash"></i></button></p>
            </div>
            @endforeach
        </div>
        <div class="w-full md:w-1/2">
            <div class="bg-gray-700 text-white">

                <form action="{{route('invitation.store')}}" method="post" class="p-6">
                    @csrf
                        <h2 class="mb-3  border-b-2 border-blue-700 text-lg font-semibold text-white lg:text-4xl title-font">
                            {{__('Send Invitation')}}
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
                                class="px-8 py-2 font-semibold text-white transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-gradient-to-r from-blue-700 hover:from-blue-600 to-blue-600 hover:to-blue-700 focus:ring focus:outline-none">{{__('send')}}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>

</script>
