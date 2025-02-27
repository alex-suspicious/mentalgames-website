@props(['tabs', 'defaultTab', 'class'])

<div x-data="{ activeTab: '{{ $defaultTab }}' }" x-init="
    $watch('activeTab', value => window.dispatchEvent(new CustomEvent('tab-changed', { detail: value })))">
    <!-- Tab Buttons -->
    <div class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 {{ $class }}">
        @foreach ($tabs as $tab)
            <button
                @click="activeTab = '{{ $tab }}'"
                :class="{ 'border-white text-white border-b-2': activeTab === '{{ $tab }}' }"
                class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300"
            >
                {{ mb_ucfirst(__($tab)) }}
            </button>
        @endforeach
    </div>
</div>
