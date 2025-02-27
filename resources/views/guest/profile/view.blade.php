<x-app-layout>

    <div class="lg:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lg:grid grid-flow-col gap-8">
              <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg text-white">
                <div class="h-40 bg-pink-500">
                    
                </div>
                <div class="-mt-24 px-4">
                    <div class="grid justify-items-stretch">
                        <img class="size-40 justify-self-start rounded-full object-cover border-8 border-white dark:border-gray-800" src="{{ $user->profile_photo_url }}">
                        <x-sick-button href="{{ route('profile.show') }}" class="justify-self-end -mt-12">
                            {{ __('Edit profile') }}
                        </x-sick-button>
                    </div>
                </div>
                <div class="p-3">
                    <div class="text-3xl font-bold pl-4">{{ $user->name }}</div>
                    <div class="pl-4 text-m opacity-35 -mt-1">{{ '@' . $user->url }}</div>
                    <div class="pl-4 mt-2">{{ $user->bio }}</div>
                </div>
              </div>
              <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg text-white p-3">
                  
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
