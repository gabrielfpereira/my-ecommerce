<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="p-6 text-gray-900 dark:text-white">
                        <h2>{{ __("Categorias") }}</h2>
                    </div>
    
                    <a
                        href="{{ route('categorias.create') }}"
                        type="button"
                        class="px-4 py-2 m-2 text-white transition duration-500 bg-indigo-500 border border-indigo-500 rounded-md select-none ease hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                    >
                        Adiconar
                    </a>
                </div>

            <div class="w-full p-6 overflow-hidden md:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" @class(["px-3 py-3.5 text-left text-sm font-semibold text-gray-900  dark:text-white"]) >
                                    Categoria
                                </th>

                                <th scope="col" @class(["px-3 py-3.5 text-left text-sm font-semibold text-gray-900  dark:text-white"]) >
                                    Criação
                                </th>

                                <th scope="col" @class(["px-3 py-3.5 text-left text-sm font-semibold text-gray-900  dark:text-white"]) >
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <tr class="bg-white dark:bg-gray-700">
                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $category->created_at }}
                                    </td>
                                    
                                    <td class="flex px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                                        <a  
                                            href="{{ route('categorias.edit', $category->id) }}"
                                            type="button"
                                            class="px-4 py-2 m-2 text-white transition duration-500 bg-yellow-500 border border-yellow-500 rounded-md select-none ease hover:bg-yellow-600 focus:outline-none focus:shadow-outline"
                                        >
                                            Editar
                                    </a>

                                        <form action="{{ route('categorias.destroy', $category->id) }}" id="form-{{$category->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="deleteButton(event, {{ $category->id }})"
                                                type="button"
                                                class="px-4 py-2 m-2 text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline"
                                            >
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                </div>
            </div>
            </div>
        </div>
    </div>
    @if (session()->has('message'))
        @push('js')
            <script>
                Swal.fire('Categoria criada com sucesso!')
            </script>
        @endpush
        
    @endif

    @push('js')
    <script>
        function deleteButton(event, id){
            event.preventDefault()
           
            console.log(event)
            Swal.fire({
            title: 'Você deseja mesmo excluir?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'sim',
            denyButtonText: `Não salve`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                document.querySelector('#form-'+id).submit()
                // Swal.fire('Alteração salva', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Alterações não salvas', '', 'info')
            }
            })
        }
       
    </script>
    @endpush
</x-app-layout>