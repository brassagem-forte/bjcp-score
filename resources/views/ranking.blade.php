<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ranking
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ol class="list-decimal list-inside">
                        @foreach($users as $i => $user)
                        <li class="text-{{ 6-$i > 1 ? 6-$i : '' }}xl border-b border-gray-200 p-2">
                            <a href="{{ route('show', [$user->id, Str::slug($user->name)]) }}">
                            {{ $user->name }}: <span class="md:float-right">{{ $user->total }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
