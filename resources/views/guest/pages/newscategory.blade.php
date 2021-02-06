<x-guest-layout>
@if (count($posts)!==0)
{{__('here i show')}}
@else
    {{__('Nothing to show')}}
@endif
</x-guest-layout>
