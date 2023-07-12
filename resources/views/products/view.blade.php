<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="p-6 text-gray-900 dark:text-white">
                        <h2>{{ __("Criar Produto") }}</h2>
                    </div>

                    <a
                        href="{{ route('produtos.index') }}"
                        type="button"
                        class="px-4 py-2 m-2 text-white transition duration-500 bg-indigo-500 border border-indigo-500 rounded-md select-none ease hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                    >
                        voltar
                    </a>
                </div>

                <div class="p-6">
                    <div class="px-4 mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
                        <div class="flex flex-col -mx-4 md:flex-row">
                          <div class="px-4 md:flex-1">
                            <div x-data="{ image: 1 }" x-cloak>
                              <div class="h-64 mb-4 bg-gray-100 rounded-lg md:h-80">
                                  @if($product->getMedia()->count() === 0)
                                      <div x-show="image === 1" class="flex items-center justify-center h-64 mb-4 bg-gray-100 rounded-lg md:h-80">
                                          <img src="/images/no-image.png">
                                      </div>
                                  @else
                                      @foreach($product->getMedia() as $media)
                                          <div x-show="image === {{$loop->iteration}}" class="flex items-center justify-center h-64 mb-4 bg-gray-100 rounded-lg md:h-80">
                                              <img src="{{$media->getFullUrl() != "" ? $media->getFullUrl() : '/images/no-image.png' }}">
                                          </div>
                                      @endforeach
                                  @endif


                              </div>

                              <div class="flex mb-4 -mx-2">
                                  @if($product->getMedia()->count() === 0)
                                      <div class="flex-1 px-2">
                                          <button x-on:click="image = 1" :class="{ 'ring-2 ring-indigo-300 ring-inset': image === i }" class="flex items-center justify-center w-36 h-24 bg-gray-100 rounded-lg focus:outline-none md:h-32">
                                              <img src="/images/no-image.png">
                                          </button>
                                      </div>
                                  @else
                                      @foreach($product->getMedia() as $media)

                                          <div class="flex-1 px-2">
                                              <button x-on:click="image = {{$loop->iteration}}" :class="{ 'ring-2 ring-indigo-300 ring-inset': image === i }" class="flex items-center justify-center w-36 h-24 bg-gray-100 rounded-lg focus:outline-none md:h-32">
                                                  <img src="{{$media->getFullUrl() != "" ? $media->getFullUrl() : '/images/no-image.png' }}">
                                              </button>
                                          </div>
                                      @endforeach
                                  @endif
                              </div>
                            </div>
                          </div>
                          <div class="px-4 md:flex-1">
                            <h2 class="mb-2 text-2xl font-bold leading-tight tracking-tight text-gray-800 md:text-3xl">{{ $product->name }}</h2>
{{--                            <p class="text-sm text-gray-500">By <a href="#" class="text-indigo-600 hover:underline">ABC Company</a></p>--}}

{{--                            <div class="flex items-center my-4 space-x-4">--}}
{{--                              <div>--}}
{{--                                <div class="flex px-3 py-2 bg-gray-100 rounded-lg">--}}
{{--                                  <span class="mt-1 mr-1 text-indigo-400">$</span>--}}
{{--                                  <span class="text-3xl font-bold text-indigo-600">25</span>--}}
{{--                                </div>--}}
{{--                              </div>--}}
{{--                              <div class="flex-1">--}}
{{--                                <p class="text-xl font-semibold text-green-500">Save 12%</p>--}}
{{--                                <p class="text-sm text-gray-400">Inclusive of all Taxes.</p>--}}
{{--                              </div>--}}
{{--                            </div>--}}

                            <p class="text-gray-500 my-6">{{$product->description}}</p>
                              <div>
                                  {{__('Categoria(s):')}}
                                  <ul>
                                      @foreach($product->categories as $category)
                                          <li>{{ $category->name }}</li>
                                      @endforeach
                                  </ul>
                              </div>

{{--                            <div class="flex py-4 space-x-4">--}}
{{--                              <div class="relative">--}}
{{--                                <div class="absolute left-0 right-0 block pt-2 text-xs font-semibold tracking-wide text-center text-gray-400 uppercase">Qty</div>--}}
{{--                                <select class="flex items-end pb-1 pl-4 pr-8 border border-gray-200 appearance-none cursor-pointer rounded-xl h-14">--}}
{{--                                  <option>1</option>--}}
{{--                                  <option>2</option>--}}
{{--                                  <option>3</option>--}}
{{--                                  <option>4</option>--}}
{{--                                  <option>5</option>--}}
{{--                                </select>--}}

{{--                                <svg class="absolute bottom-0 right-0 w-5 h-5 mb-2 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />--}}
{{--                                </svg>--}}
{{--                              </div>--}}

                              <button type="button" class="px-6 py-2 font-semibold text-white bg-indigo-600 h-14 rounded-xl hover:bg-indigo-500">
                                Add to Cart
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
