<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>
<div class="p-5">
    @if (Session::has('success'))
    <div class="alert-banner w-full">
        <input type="checkbox" class="hidden" id="banneralert">

        <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white" title="close" for="banneralert">
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
                <h3 class="tracking-widest text-3xl border-b-2 border-blue-700 p-2 mx-2 font-bold ">{{__('Comments_for_Review')}}</h3>
                <div class="px-2 my-4" style="max-height: 600px; overflow-y:auto">
                <table class="table-auto w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="p-2">{{__('Name')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Text')}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-center bg-white">
                        @foreach($coms as $com)
                        <tr class="text-black">
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
