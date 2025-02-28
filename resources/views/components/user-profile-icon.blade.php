@if( !is_null($user) )
    <a class="relative group inline-block" href="/profile/{{ $user->url }}">
        <img class="size-40 justify-self-start rounded-full object-cover border-8 border-white dark:border-gray-800 hover:border-gray-700" src="{{ $user->profile_photo_url }}">
        <span class="absolute left-full top-1/2 -translate-y-1/2 ml-2 w-max p-4 text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity overflow-hidden hidden xl:block">
            @if( $user->background_photo_path )
                <img class="absolute size-fit -m-4 opacity-10" src="{{$user->background_photo_url}}">
            @endif
            <div class="text-3xl font-bold">{{ $user->name }}</div>
            <div class="text-m opacity-35 -mt-1">{{ '@' . $user->url }}</div>
            <div class="mt-3">{{ $user->bio }}</div>
            <div class="text-m mt-3 opacity-35"><span class="material-symbols-outlined text-sm">calendar_month</span> {{__("Joined")}} {{ __($user->created_at->format('F')) }} {{ $user->created_at->format('Y') }}</div>
        </span>

        <span class="absolute w-full mt-4 p-2 text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity overflow-hidden hidden sm:block xl:hidden">
            @if( $user->background_photo_path )
                <img class="absolute size-fit -m-4 opacity-10" src="{{$user->background_photo_url}}">
            @endif
            <div class="font-bold">{{ $user->name }}</div>
        </span>
    </a>

@endif
