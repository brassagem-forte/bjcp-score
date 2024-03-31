@props(['on'])
<div>
    <div x-data="{ shown: false, timeout: null }"
        x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
        x-show.transition.out.opacity.duration.1500ms="shown"
        x-transition:leave.opacity.duration.1500ms
        style="display: none;"
        {{ $attributes->merge(['class' => 'fixed bottom-2 right-2 max-w-xs font-bold bg-green-500 text-sm text-white rounded-md shadow-lg mb-3 ml-3 w-60']) }}>
        <div class="flex p-4">
            {{ $slot->isEmpty() ? 'Saved.' : $slot }}
        </div>
    </div>
</div>
