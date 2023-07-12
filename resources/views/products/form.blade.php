
<form action="{{ $routeTo }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="relative z-0 w-full mb-6 group">
      <input value="{{ isset($product) ? $product->name : '' }}" type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
      <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nome do Produto</label>
      @error('name') <span>{{$message}}</span> @enderror
    </div>
    <div class="relative z-0 w-full mb-6 group">
      <input value="{{ isset($product) ? $product->description : '' }}" type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
      <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descrição</label>
      @error('description') <span>{{$message}}</span> @enderror
    </div>

    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-6 group">
        <input value="{{ isset($product) ? $product->price : '' }}" type="text" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Preço</label>
        @error('price') <span>{{$message}}</span> @enderror
      </div>
      <div class="relative z-0 w-full mb-6 group">
          <input value="{{ isset($product) ? $product->quantity : '' }}" type="number" name="quantity" id="quantity" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="quantity" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quantidade</label>
          @error('quantity') <span>{{$message}}</span> @enderror
      </div>

      <div class="relative z-0 w-full mb-6 group">
        <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorias</label>
        <select name="categories[]" multiple id="categories" class="js-example-basic-multiple bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          @foreach ($categories as $category)
            @if (isset($product))
                @foreach ($product->categories as $productCategory)
                  @if($productCategory->id === $category->id)
                    <option selected type="number" value="{{$category->id}}">{{ $category->name }}</option>
                  @else
                  <option type="number" value="{{$category->id}}">{{ $category->name }}</option>
                  @endif
                  @endforeach()
            @else
                  <option type="number" value="{{$category->id}}">{{ $category->name }}</option>
            @endif

          @endforeach
        </select>
        @error('categories') <span>{{$message}}</span> @enderror
      </div>

      <div class="relative z-0 w-full mb-6 group">
        <input type="file" name="images" id="images">
      </div>



    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</button>
  </form>

  @push('js')
    <script>
      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
      });

      FilePond.registerPlugin(FilePondPluginImagePreview);

        // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);

      FilePond.setOptions({
          server: {
              url : '/upload',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }
      });
    </script>
  @endpush
