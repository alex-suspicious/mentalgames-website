<x-app-layout>

    <div class="lg:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-8">
              <div class="col-span-12 lg:col-span-7">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg text-white">
                    <div class="h-40 bg-pink-500 overflow-hidden">
                        @if( $user->background_photo_path )
                            <img class="w-full h-full object-cover" src="{{ $user->background_photo_url }}">
                        @endif
                    </div>
                    <div class="-mt-24 px-4">
                        <div class="grid justify-items-stretch">
                            <img class="size-40 justify-self-start rounded-full object-cover border-8 border-white dark:border-gray-800" src="{{ $user->profile_photo_url }}">
                            @if( $user == Auth::user() )
                                <x-sick-button href="{{ route('profile.show') }}" class="justify-self-end -mt-12">
                                    {{ __('Edit profile') }}
                                </x-sick-button>
                            @else
                                <div class="justify-self-end -mt-12">
                                    <x-sick-button href="{{ route('profile.show') }}" class="mr-4">
                                        {{ __('Message') }}
                                    </x-sick-button>

                                    <x-sick-white-button href="{{ route('profile.show') }}">
                                        {{ __('Subscribe') }}
                                    </x-sick-white-button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="text-3xl font-bold pl-4">{{ $user->name }}</div>
                        <div class="pl-4 text-m opacity-35 -mt-1">{{ '@' . $user->url }}</div>
                        <div class="pl-4 mt-3">{{ $user->bio }}</div>
                        <div class="pl-4 text-m mt-4 opacity-35"><span class="material-symbols-outlined text-sm">calendar_month</span> {{__("Joined")}} {{ __($user->created_at->format('F')) }} {{ $user->created_at->format('Y') }}</div>
                    </div>

                    <x-tabs-navigation :tabs="['posts', 'replies', 'addons', 'games']" defaultTab="posts" class="pl-4"/>
                </div>

                <x-tabs-content defaultTab="posts">
                    <div x-show="activeTab === 'posts'" >
                        @include("guest.profile.tabs.posts")
                    </div>

                    <div x-show="activeTab === 'replies'" >
                        <p>Settings content here...</p>
                    </div>

                    <div x-show="activeTab === 'addons'" >
                        <p>Settings content here...</p>
                    </div>

                    <div x-show="activeTab === 'games'" >
                        <p>Settings content here...</p>
                    </div>
                </x-tabs-content>
              </div>
              <div class="col-span-12 lg:col-span-5 h-32 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg text-white p-3">

              </div>
            </div>
        </div>
    </div>
</x-app-layout>
