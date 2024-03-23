<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de estilos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-3 rounded relative" role="alert">
                <strong class="font-bold">Feito!</strong>
                <span class="block sm:inline">Lista de estilos atualizada.</span>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
                <div class="p-6 bg-white ">
                    <strong>Sua URL pública: </strong> <a href="{{ route('show', [$user->id, $user->slug]) }}">{{ route('show', [$user->id, $user->slug]) }}</a>
                </div>
            </div>

            <div class="my-5 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Andamento</h3>
                <div class="chart-year-container" style="position: relative; width:100%">
                    <canvas id="chart-year"></canvas>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{request()->routeIs('dashboard') ? route('missing') : route('dashboard')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-1 mt-1 text-xl float-right">
                        @if(request()->routeIs('dashboard'))
                            Filtrar faltantes
                        @else
                            Mostrar todos
                        @endif
                    </a>
                    <form method="POST" action="{{ request()->routeIs('dashboard') ? route('store') : route('store', ['filtered']) }}">
                        @method('PUT')
                        @csrf
                        <table class="border-collapse w-full">
                            <tbody>
                                @foreach($categories as $category)
                                @if($category->styles->count() > 0)
                                <tr class="border-b hover:bg-gray-50">
                                    <td colspan="2" class="text-3xl p-2">{{ $category->id }}.{{ $category->name }}</td>
                                </tr>
                                @foreach($category->styles as $style)
                                <tr class="border-b">
                                    <td class="pl-10 p-2">
                                        {{ $style->code }}. {{ $style->name }}
                                        @foreach($userMedals->where('style_id', $style->id)->all() as $medal)
                                        {{ $medal->icon }}
                                        @endforeach
                                    </td>
                                    <td class="pl-10 text-right pr-2">
                                        <input type="checkbox" name="style[]" value="{{ $style->id }}" @if($userStyles->contains($style->id)) checked="checked" @endif class="rounded text-gray-500 h-6 w-6" />
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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
                        <x-button class="ml-1 mt-3 text-2xl">
                            Salvar
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
