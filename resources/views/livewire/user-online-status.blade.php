<div wire:poll.5s>
    @if( $status > 0 )
        <div class="bg-green-500 w-12 h-12 -mt-14 ml-28 rounded-full border-8 border-white dark:border-gray-800"></div>
    @else
        <div class="bg-gray-900 w-12 h-12 -mt-14 ml-28 rounded-full border-8 border-white dark:border-gray-800"></div>
    @endif
</div>