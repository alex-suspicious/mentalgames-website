<span>
    @if( $subscribed )
        <x-sick-button wire:click="subscribe">
            {{ __('Unsubscribe') }}
        </x-sick-button>
    @else
        <x-sick-white-button wire:click="subscribe">
            {{ __('Subscribe') }}
        </x-sick-white-button>
    @endif
</span>
