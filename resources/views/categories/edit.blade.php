<x-app-layout>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="flex justify-between">
                <div class="p-6 text-gray-900 dark:text-white">
                    <h2>{{ __("Criar Categoria") }}</h2>
                </div>

                <a
                    href="{{ route('categorias.index') }}"
                    type="button"
                    class="px-4 py-2 m-2 text-white transition duration-500 bg-indigo-500 border border-indigo-500 rounded-md select-none ease hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                >
                    voltar
                </a>
            </div>
            @include('categories.form', ['method' => 'PUT', 'routeTo' => route('categorias.update', $category->id), ])
        </div>
    </div>
</x-app-layout>