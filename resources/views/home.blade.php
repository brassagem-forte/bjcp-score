<x-app-layout>
    <div class="py-12 max-w-3xl mx-auto">
        <div class=" relative z-10 sm:mt-10 md:mt-20 flex flex-col justify-center items-center h-full text-center">
            <h1 class="text-7xl font-bold leading-tight mb-4 text-gray-800 dark:text-gray-200 ">BJCP Score</h1>
            <p class="text-lg text-gray-1000 dark:text-gray-400  mb-8">O BJCP Score existe como um incentivo a cervejeiros e cervejeiras caseiras a testarem novos estilos através de uma competição saudável <s>(menos para o Estevão)</s>.</p>

            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Começar</a>
        </div>
        <div class="text-center absolute inset-x-0 bottom-0 mb-5">
            <small>* o BJCP Score não tem nenhuma filiação com o <a href="https://www.bjcp.org/" target="_blank">BJCP.org</a></small>
        </div>
    </div>
</x-app-layout>
