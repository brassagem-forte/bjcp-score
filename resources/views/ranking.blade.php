<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ranking
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto ">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div class="my-5 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Usuários</h3>
                <ol class="list-decimal list-inside">
                    @foreach($users as $i => $user)
                    <li class="text-{{ 4-$i > 1 ? 4-$i : '' }}xl border-b border-gray-200 p-2">
                        <a href="{{ route('show', [$user->id, Str::slug($user->name)]) }}">
                        {{ $user->name }}: <span class="md:float-right">{{ $user->total }}</span>
                        </a>
                    </li>
                    @endforeach
                </ol>
            </div>
            <div class="my-5 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Estilos</h3>
                <div class="chart-container" style="position: relative; height:130vh; width:100%">
                    <canvas id="chart"></canvas>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
