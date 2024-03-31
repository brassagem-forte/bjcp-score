<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modo Vs.
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 overflow-hidden shadow sm:rounded-lg mb-3">
                <form method="get" action="{{ route('compare') }}">
                    <select class="m-6" name="user[]">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($compareUsers[0]->info->id == $user->id) selected="selected" @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select class="m-6" name="user[]">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($compareUsers[1]->info->id == $user->id) selected="selected" @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-secondary-button type="submit" class="mt-0 m-6 text-xl">
                        Comparar
                    </x-secondary-button>
                </form>
            </div>
            <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-700">
                    <table class="border-collapse w-full">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($compareUsers as $user)
                                <th class="text-center">
                                    {{ $user->info->first_name }}
                                </th>
                                @endforeach
                            </tr>
                            <tr>
                                <th class="text-right">Estilos brassados de {{ $stylesCount }}:</th>
                                @foreach($compareUsers as $user)
                                <th class="text-center">
                                    {{ $user->styles->count() }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr class="border-b border-gray-500 hover:bg-gray-700">
                                <td class="text-3xl p-2" colspan="3">{{ $category->name }}</td>
                            </tr>
                            @foreach($category->styles as $style)
                            <tr class="border-b border-gray-500 hover:bg-gray-700">
                                <td class="md:pl-10 p-2">{{ $style->code }}. {{ $style->name }}</td>
                                @foreach($compareUsers as $user)
                                <td class="text-center pr-2">
                                    <input type="checkbox" name="style[]" value="{{ $style->id }}" @if($user->styles->contains($style->id)) checked="checked" @endif disabled="disabled" class="rounded text-gray-500 h-6 w-6" />
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="pt-4 pb-4 pl-2 pr-2 text-3xl">
                                    Total: {{ $stylesCount }}
                                </td>
                                @foreach($compareUsers as $user)
                                <td class="pt-4 pb-4 pl-2 pr-2 text-3xl text-center">
                                    {{ $user->styles->count() }}
                                </td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
