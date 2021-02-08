<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>
<div class="p-5">
    @if (Session::has('success'))
    <div class="alert-banner w-full fixed top-0">
        <input type="checkbox" class="hidden" id="banneralert">

        <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white" title="close" for="banneralert">
            {{ Session::get('success') }}

          <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
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
    <section class="text-gray-700 body-font my-4">
        <div class="container mx-auto">
            <div class="rounded border-gray-700 border-2 bg-gray-200 ">
                <h3 class="tracking-widest text-lg border-b-4 border-gray-700 p-2 mx-2">{{__('Comments_for_Review')}}</h3>
                <div style="max-height: 600px; overflow-y:auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="p-2">{{__('Name')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Text')}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($coms as $com)
                        <tr>
                            <td class="p-2 m-2">
                                <p>{{$com->name}}</p>
                            </td>
                            <td>
                                <p>{{\Carbon\Carbon::parse($com->created_at)->format('d-m-y')}}</p>
                            </td>
                            <td>
                                <p>{{$com->comment}}</p>
                            </td>
                            <td>
                                <form action="{{route('comment.accept',$com->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                class="bg-green-500 px-4 py-2 rounded text-white ">{{__('Accept')}}</button>
                                </form>

                            </td>
                            <td class="p-2 m-2">
                                <form action="{{route('comment.delete',$com->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class=" submi bg-red-500 px-4 py-2 rounded text-white">{{__('Delete')}}</button>
                                </form>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </section>
</div>
</x-app-layout>
