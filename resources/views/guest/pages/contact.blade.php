<x-guest-layout>


 <section class="text-gray-700 body-font pb-24 md:pb-36">
            <div class="container px-8 pt-48 pb-24 mx-auto lg:px-4">
                <h1 class="text-xl text-center p-4">@lang('main.Contact_us')</h1>
                @if(session('success'))
                <div class="w-80 px-8 py-2 mx-auto my-2 font-semibold text-white transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-indigo-700">
                    {!! session('success')!!}
                </div>
                @endif
                <div class="flex flex-col w-full p-8 mx-auto mt-10 border rounded-lg lg:w-2/6 md:w-1/2 md:ml-auto md:mt-0">
                    <form action="{{route('contact')}}" method="post">
                    @csrf
                    <div class="relative ">
                        <input type="name" id="name" name="name" placeholder=@lang('main.Name')
                            class="w-full px-4 py-2 mb-4 mr-4 text-base text-blue-700 bg-gray-100 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0">
                    </div>
                    <input type="hidden" name="email">
                    <div class="relative ">
                        <input type="name" id="name" name="email2" placeholder=@lang('main.Email')
                            class="w-full px-4 py-2 mb-4 mr-4 text-base text-blue-700 bg-gray-100 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0">
                    </div>
                    <input type="hidden" name="address">
                    <textarea type="message" class="hidden" name="message"></textarea>
                    <div class="relative ">
                        <textarea type="message" id="message" name="message2" placeholder=@lang('main.message')
                            class="w-full px-4 py-2 mb-4 mr-4 text-base text-blue-700 bg-gray-100 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0"></textarea>
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms"/>

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif
                    <button type="submit" id="btn-submit"
                        class="w-full px-8 py-2 font-semibold text-white transition duration-500 ease-in-out transform rounded-lg shadow-xl bg-gradient-to-r from-indigo-700 hover:from-indigo-600 to-indigo-600 hover:to-green-300 focus:ring focus:outline-none">@lang('main.Send')</button>
                    </form>

                </div>

            </div>
        </section>

        <script async>

            $('#btn-submit').on('click',function(){
                $(this).attr('disabled',true);
            })
        </script>


</x-guest-layout>

