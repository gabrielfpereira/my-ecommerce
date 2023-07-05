<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex justify-between">
                <div class="p-6 text-gray-900 dark:text-white">
                    <h2>{{ __("Criar Categoria") }}</h2>
                </div>

                <a
                    href="{{ route('categorias.index') }}"
                    type="button"
                    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                >
                    voltar
                </a>
            </div>

            @include('categories.form', ['method' => 'POST', 'routeTo' => route('categorias.store')])
        </div>
    </div>
</x-app-layout>