<span wire:poll.10s="refreshSubscribers">
    @if( $subscribed )
        <x-sick-white-button wire:click="subscribe">
            <span class="hidden lg:inline">{{ __('Unsubscribe') }}</span>
            <span class="inline lg:hidden"><span class="material-symbols-outlined">person_remove</span></span>
        </x-sick-white-button>
    @else
        <x-sick-button wire:click="subscribe">
            <span class="hidden lg:inline">{{ __('Subscribe') }}</span>
            <span class="inline lg:hidden"><span class="material-symbols-outlined">person_add</span></span>
        </x-sick-button>
    @endif
</span>
