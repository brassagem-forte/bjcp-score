<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modo Vs.
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="border-collapse w-full">
                        <thead>
                            <td></td>
                            @foreach($users as $user)
                            <td>{{ $user->info->name }}</td>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="text-3xl p-2">{{ $category->name }}</td>
                            </tr>
                            @foreach($category->styles as $style)
                            <tr class="border-b">
                                <td class="pl-10 p-2">{{ $style->code }}. {{ $style->name }}</td>
                                @foreach($users as $user)
                                <td class="pl-10 text-right pr-2">
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
                                @foreach($users as $user)
                                <td class="pt-4 pb-4 pl-2 pr-2 text-3xl text-right">
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
