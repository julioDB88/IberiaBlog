<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.Invitations')
        </h2>
    </x-slot>
    <div class="p-1 md:p-5 flex flex-wrap">
        @if($errors->any())
        <div class="bg-red-500 p-3 w-full rounded text-white">
            @foreach ($errors->all() as $error)
            <p class=text-white">{{$error}} </p>
            @endforeach
        </div>
        @endif
        @if (session('success'))
        <div class="bg-green-500 p-3 my-2 w-full rounded text-white">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="bg-red-500 p-3 my-2 w-full rounded text-white">{{ session('error') }}</div>
        @endif

        <div class="w-full md:w-1/2 bg-gray-700">
            <div class="p-6">
                <h2 class="mb-3  border-b-2 border-blue-700 text-lg font-bold text-white lg:text-4xl title-font">
                    @lang('main.Pending Invitations')
                </h2>
                <table class="w-full bg-white rounded-t py-2 table table-responsive">
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
                        <div class="py-2" x-data="{ show: true }">
                            <div class="relative">
                              <input name="password" placeholder="password" :type="show ? 'password' : 'text'" class="text-md block px-3 py-2 rounded-lg w-full
                            bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                            focus:placeholder-gray-500
                            focus:bg-white
                            focus:border-gray-600
                            focus:outline-none">
                              <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                  :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                  viewbox="0 0 576 512">
                                  <path fill="currentColor"
                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                  </path>
                                </svg>

                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                  :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                  viewbox="0 0 640 512">
                                  <path fill="currentColor"
                                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                  </path>
                                </svg>

                              </div>
                            </div>
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
