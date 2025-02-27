@props(['defaultTab'])

<div x-data="{ activeTab: '{{ $defaultTab }}' }"
    @tab-changed.window="activeTab = $event.detail">
   {{ $slot }}
</div>
