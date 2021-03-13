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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('store') }}">
                        @method('PUT')
                        @csrf
                        <table class="border-collapse w-full">
                            <tbody>
                                @foreach($categories as $category)
                                <tr class="border-b hover:bg-gray-50">
                                    <td colspan="2" class="text-3xl p-2">{{ $category->id }}.{{ $category->name }}</td>
                                </tr>
                                @foreach($category->styles as $style)
                                <tr class="border-b">
                                    <td class="pl-10 p-2">{{ $style->code }}. {{ $style->name }}</td>
                                    <td class="pl-10 text-right pr-2">
                                        <input type="checkbox" name="style[]" value="{{ $style->id }}" @if($userStyles->contains($style->id)) checked="checked" @endif class="rounded text-gray-500 h-6 w-6" />
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
                        <x-button class="ml-1 mt-3 text-2xl">
                            Salvar
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
