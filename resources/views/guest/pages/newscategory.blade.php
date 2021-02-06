<x-guest-layout>
@if (count($posts)!==0)
 <p>{{__('here i show')}}</p>
@else
    <p class="font-bold text-center py-4">{{__('Nothing to show')}}</p>
@endif
</x-guest-layout>
