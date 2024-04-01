<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de estilos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 overflow-hidden shadow sm:rounded-lg mb-3">
                <div class="p-6">
                    <h3 class="text-3xl">{{ $user->name }}</h3>
                </div>
            </div>

            <div class="my-5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-xl leading-tight">Andamento</h3>
                <div class="chart-year-container" style="position: relative; width:100%">
                    <canvas id="chart-year" data-userid="{{ $user->id }}"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-700">
                    <table class="border-collapse w-full">
                        <tbody>
                            @foreach($categories as $category)
                            <tr class="border-b border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td colspan="2" class="text-3xl p-2">{{ $category->id }}.{{ $category->name }}</td>
                            </tr>
                            @foreach($category->styles as $style)
                            <tr class="border-b border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="pl-10 p-2">{{ $style->code }}. {{ $style->name }}</td>
                                <td class="pl-10 text-right pr-2">
                                    <input type="checkbox" name="style[]" value="{{ $style->id }}" @if($userStyles->contains($style->id)) checked="checked" @endif disabled="disabled" class="rounded text-gray-500 h-6 w-6" />
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="pt-4 pb-4 pl-2 pr-2">
                                    <div class="text-3xl float-left">Total:</div>
                                    <div class="float-right">
                                        {{ $stylesCount }} / <span class="text-2xl">{{ $userStyles->count() }}</span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
