<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="p-6 text-gray-900 dark:text-white">
                        <h2>{{ __("Produtos") }}</h2>
                    </div>
    
                    <a
                        href="{{ route('produtos.create') }}"
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
                                    Produtos
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
                            @foreach ($products as $product)
                                <tr class="bg-white dark:bg-gray-700">
                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $product->name }}
                                    </td>

                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $product->created_at }}
                                    </td>
                                    
                                    <td class="flex px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                                        <a  
                                            href="{{ route('produtos.edit', $product->id) }}"
                                            type="button"
                                            class="px-4 py-2 m-2 text-white transition duration-500 bg-yellow-500 border border-yellow-500 rounded-md select-none ease hover:bg-yellow-600 focus:outline-none focus:shadow-outline"
                                        >
                                            Editar
                                    </a>

                                        <form action="{{ route('produtos.destroy', $product->id) }}" id="form-{{$product->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="deleteButton(event, {{ $product->id }})"
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
                        {{ $products->links() }}
                </div>
            </div>
            </div>
        </div>
    </div>
    @if (session()->has('message'))
    
    <div id="toast-top-right" class="fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">       
         <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z"/>
                </svg>
                <span class="sr-only">Fire icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{session('message')}}</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>

    </div>

        {{-- @push('js')
            <script>
                Swal.fire()
            </script>
        @endpush --}}
        
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