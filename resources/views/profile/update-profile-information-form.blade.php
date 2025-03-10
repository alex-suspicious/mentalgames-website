<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile / Background Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            wire:model="state.photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>

            <div x-data="{backgroundName: null, backgoundPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Background Photo File Input -->
                <input type="file" id="background" class="hidden"
                            wire:model.live="background"
                            wire:model="state.background"
                            x-ref="background"
                            x-on:change="
                                    backgroundName = $refs.background.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        backgoundPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.background.files[0]);
                            " />

                <x-label for="backgound" value="{{ __('Background') }}" />

                <!-- Current Background Background -->
                <div class="mt-2" x-show="! backgoundPreview">
                    <div class="h-40 bg-pink-500 overflow-hidden rounded-lg">
                        @if( $this->user->background_photo_path )
                            <img class="w-full h-full object-cover" src="{{ $this->user->background_photo_url }}">
                        @endif
                    </div>
                </div>

                <!-- New Background Background Preview -->
                <div class="mt-2" x-show="backgoundPreview" style="display: none;">

                    <div class="h-40 bg-pink-500 overflow-hidden rounded-lg">
                        <img class="w-full h-full object-cover" x-bind:src="backgoundPreview">
                    </div>


                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.background.click()">
                    {{ __('Select A New Background') }}
                </x-secondary-button>

                @if ($this->user->background_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteBackgroundPhoto">
                        {{ __('Remove Background') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="background" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Url -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="url" value="{{ __('URL') }}" />
            <x-input id="url" type="text" class="mt-1 block w-full" wire:model="state.url" required autocomplete="url" />
            <x-input-error for="url" class="mt-2" />
        </div>

        <!-- bio -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="bio" value="{{ __('Bio') }}" />
            <x-input id="bio" type="text" class="mt-1 block w-full" wire:model="state.bio" autocomplete="bio" />
            <x-input-error for="bio" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo,background">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
