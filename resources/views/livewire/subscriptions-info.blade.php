<div wire:poll.10s >
    <a href="/profile/{{$user->url}}/subscribed" class="hover:underline"><b class="text-m">{{ $subscribed }}</b> <span class="opacity-35 text-sm">{{__("Subscribed")}}</span></a> <a class="hover:underline" href="/profile/{{$user->url}}/subscribers"><b class="text-m ml-2" id="subscribers-count-render">{{ $subscribers }}</b> <span class="opacity-35 text-sm">{{__("Subscribers")}}</span></a>
</div>
