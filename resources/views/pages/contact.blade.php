<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.Contact')
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
    <form action="{{ route('pages.update','contact') }}" method="post">
        @csrf
        @method('PUT')
    </form>
</div>
</x-app-layout>
