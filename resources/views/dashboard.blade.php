<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de estilos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="overflow-hidden bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow sm:rounded-lg mb-3">
                <div class="p-6 ">
                    <strong>Sua URL pública: </strong> <a href="{{ route('show', [$user->id, $user->slug]) }}">{{ route('show', [$user->id, $user->slug]) }}</a>
                </div>
            </div>

            <div class="my-5 overflow-hidden bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow sm:rounded-lg p-6">
                <h3 class="font-semibold text-xl leading-tight">Andamento</h3>
                <div class="chart-year-container" style="position: relative; width:100%">
                    <canvas id="chart-year"></canvas>
                </div>
            </div>

            <div class="overflow-hidden bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow sm:rounded-lg">
                <livewire:styles.list />
            </div>
        </div>
    </div>
</x-app-layout>
