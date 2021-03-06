<x-guest-layout>
    <div class="py-12 px-6">
        <div class="flex flex-wrap">
            @foreach ($vids as $vid)

            @endforeach
            {{$vids->links()}}
        </div>

    </div>
</x-guest-layout>


