<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto shadow-md">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:mt-10">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mb-4 text-sm text-gray-600">
                        Esqueceu sua senha? Não tem problema. Preencha seu e-mail e enviaremos o link para resetar sua senha.
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                Enviar link por e-mail
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
