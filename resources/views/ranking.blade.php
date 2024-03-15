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
                    <li class="text-{{ 3-$i > 1 ? 3-$i : '' }}xl border-b border-gray-200 p-2">
                        <a href="{{ route('show', [$user->id, Str::slug($user->name)]) }}">
                        {{ $user->name }}: <span class="md:float-right">{{ $user->total }}</span>
                        </a>
                    </li>
                    @endforeach
                </ol>
            </div>
            <div>
                <div class="my-5 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Estilos mais Brassados</h3>
                    <ol class="list-decimal list-inside">
                        @foreach($moreBrewed as $i => $style)
                        <li class="text-{{ 3-$i > 1 ? 3-$i : '' }}xl border-b border-gray-200 p-2">
                            <a href="{{ route('show', [$user->id, Str::slug($user->name)]) }}">
                            {{ $style->name }}: <span class="md:float-right">{{ $style->total }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ol>
                </div>
                <div class="my-5 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Estilos menos Brassados</h3>
                    <ol class="list-decimal list-inside">
                        @foreach($lessBrewed as $i => $style)
                        <li class="text-xl border-b border-gray-200 p-2">
                            {{ $style->name }}: <span class="md:float-right">{{ $style->total }}</span>
                        </li>
                        @endforeach
                    </ol>
                    {{-- <div class="chart-container" style="position: relative; height:230vh; width:100%">
                        <canvas id="chart"></canvas>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
