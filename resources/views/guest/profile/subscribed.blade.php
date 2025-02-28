<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-back-button></x-back-button> {{ $user->name }} {{__("Subscribed")}}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-white p-8">
                @foreach ( $subscribers as $subscriber )
                    <x-user-profile-icon :user="$subscriber"></x-user-profile-icon>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
