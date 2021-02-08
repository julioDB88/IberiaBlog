<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" ></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>
    <body>
        @include('guest.includes.guest-nav')
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        @include('layouts.footer')
        @stack('js')
        <div id="cookie-banner" class="w-full p-4 bg-indigo-700 text-white hidden " style="position: fixed;bottom: 0;">

            <div>
            <p>  @lang('main.cookies')</p>
            <button id="consent" class="rounded bg-white text-indigo-700 px-2 py-1 float-right">@lang('main.Accept')</button>

            <a href="{{route('terms.show')}}" class="bg-white px-2 py-1 text-indigo-700 rounded"> Visit Cookies</a>
            </div>

        </div>
<script>
    let consent= window.localStorage.getItem('cookie_consent')

if(!consent){

    $('#cookie-banner').toggle('slow')
}
$('#consent').on('click',function(){
    window.localStorage.setItem('cookie_consent',true)
    $('#cookie-banner').toggle('slow')
})

</script>

    </body>
</html>
