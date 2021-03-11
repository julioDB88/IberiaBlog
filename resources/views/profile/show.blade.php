<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-2 md:gap-3">
                    <div class="md:col-span-1 py-4">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900">{{__('Update Author')}}</h3>

                            <p class="mt-1 text-sm text-gray-600">
                              {{__('This info will be rendered at home page')}}
                            </p>
                        </div>
                    </div>
                    <form action="{{route('author.update')}}" method="post" class="rounded bg-white p-4">
                        @csrf
                        @method('PUT')
                        <div class="col-span-6 sm:col-span-4 p-4">
                            <x-jet-label for="subtitle" value="{{ __('Subtitle') }}" />
                            <x-jet-input name="subtitle" id="subtitle" type="text" class="mt-1 block w-full"
                                wire:model.defer="state.subtitle" />
                            <x-jet-input-error for="subtitle" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4 p-4">
                            <x-jet-label for="description" value="{{ __('Author_desription') }}" />
                            <textarea name="description" id="description" cols="20" rows="10" class="mt-1 block w-full"></textarea>
                            <x-jet-input-error for="description" class="mt-2" />
                        </div>
                        <br>
                        <button class="bg-indigo-700 text-white px-4 py-2 rounded" type="submit">{{__('Send')}}</button>
                    </form>
                </div>
            </div>
            <x-jet-section-border />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-jet-section-border />
            @endif

            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif --}}

            {{-- <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div> --}}

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
