<x-guest-layout>
    <div class="h-80 c-shadow">
        <video autoplay muted loop class=" absolute h-80 min-w-full object-cover">
            <source src="{{asset('media')}}/bg-video.mp4" type="video/mp4">
        </video>
        <div class="w-full z-0 text-center h-80 absolute main-banner p-20 md:p-32">
            <img src="{{asset('media')}}/logo.png" alt="{{config('app.name')}}" height="300" width="300"
                class="mx-auto">
            <div class="inline-block">
                <p class="text-white fzial text-3xl pb-6"> {{ config('app.name') }}</p>
                <p class="text-white hidden md:block md:text-2xl">@lang('main.lema')</p>
            </div>
        </div>

    </div>
    <div class="flex">
        <div class="w-full md:w-4/5">
            <div class="header-section w-full text-xl md:text-3xl py-16 text-center">
                @lang('main.latest-news')
            </div>
            <div class="section">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="rounded grid p-3">
                        <div>
                            <img src="https://dummyimage.com/250/000/fff.jpg"
                                alt="{{config('app.name')}} - {{__('titulo noticia')}}" class="h-32 md:h-100 float-left pr-3 pb-3 ">
                            <p class="pb-3 text-md"> This title news Rocks</p>
                            <p class="text-sm md:text-base">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere
                                magni fugiat id modi,
                                impedit necessitatibus, dolore perspiciatis sunt velit itaque, atque ea at hic dolorum sint
                                quasi
                                non perferendis explicabo.</p>
                        </div>
                        <div class="flex justify-between p-2 text-sm md:text-base"><a href="#">Author Moleu</a>
                            <p>19/12/2020</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="header-section w-full text-xl md:text-3xl py-16 text-center">
                @lang('main.pop-news')
            </div>
            <div class="section">
                <div class="grid grid-cols-1 md:grid-cols-5">
                    <div class="grid p-3">
                        <div>
                            <img src="https://dummyimage.com/250/000/fff.jpg"
                                alt="{{config('app.name')}} - {{__('titulo noticia')}}" class="h-32 md:h-100 float-left pr-3 pb-3">
                            <p class="pb-3 text-md"> This title news Rocks</p>
                            <p class="text-sm md:text-base">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Facere magni fugiat id modi,
                                impedit necessitatibus, dolore perspiciatis sunt velit itaque, atque ea at hic
                            </p>
                        </div>
                        <div class="flex justify-between p-2 text-sm md:text-base"><a href="#">Author Moleu</a>
                            <p>19/12/2020</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="hidden md:w-1/5 md:block pt-16 text-center">
            <div class="p-3">related content</div>
            <div class="p-3 grid ">
                <div class="m-3 pb-3 border">
                    <img src="https://dummyimage.com/200x100/000/fff" alt="" class="w-full pb-3 ">
                    <p>Mola</p>
                </div>
                <div class="m-3 pb-3 border">
                    <img src="https://dummyimage.com/200x100/000/fff" alt="" class="w-full pb-3 ">
                    <p>Mola</p>
                </div>
                <div class="m-3 pb-3 border">
                    <img src="https://dummyimage.com/200x100/000/fff" alt="" class="w-full pb-3 ">
                    <p>Mola</p>
                </div>
                <div class="m-3 pb-3 border">
                    <img src="https://dummyimage.com/200x100/000/fff" alt="" class="w-full pb-3 ">
                    <p>Mola</p>
                </div>


            </div>
        </div>
    </div>

    <div class="header-section w-full text-xl md:text-3xl py-16 text-center">
        @lang('main.Authors')
    </div>
    <div class="section">
        <div class="grid grid-cols-2 md:grid-cols-5">
            <div class="text-center my-6">
                <img src="https://dummyimage.com/125/000/fff" alt="" class="rounded-full mx-auto mb-4" >
                <a href="" class="border-b-2">John Doe</a>

            </div>


        </div>
    </div>

</x-guest-layout>
