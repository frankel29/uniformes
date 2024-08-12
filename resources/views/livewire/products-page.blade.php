<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
    <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
      <div class="flex flex-wrap mb-24 -mx-3">
        <div class="w-full pr-2 lg:w-1/4 lg:block">
          <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
            <h2 class="text-2xl font-bold dark:text-gray-400"> Colegios</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
            <ul>
              @foreach ($categories as $category) 
                <li class="mb-4" wire:key="{{$category->id}}">
                  <label for="{{$category->slug}}" class="flex items-center dark:text-gray-400">
                    <input type="checkbox" wire:model.live="selected_categories" id="{{$category->slug}}" 
                    value="{{$category->id}}" class="w-4 h-4 mr-2">
                    <span class="text-lg">{{ $category->name }}</span>
                  </label>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="w-full px-3 lg:w-3/4">
          <div class="px-3 mb-4">
            <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
              <div class="flex items-center justify-between">
                <select name="" id="" class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                  <option value="">Sort by latest</option>
                  <option value="">Sort by Price</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap items-center">
            @foreach ($products as $product)
              <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
                <div class="border border-gray-300 dark:border-gray-700">
                  <div class="relative bg-gray-200">
                    <a href="{{ url('products', $product->slug) }}" class="">
                      @if (!empty($product->images) && isset($product->images[0]))
                        @php
                          $imageUrl = filter_var($product->images[0], FILTER_VALIDATE_URL) ? $product->images[0] : asset('storage/' . $product->images[0]);
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="object-cover w-full h-56 mx-auto">
                      @else
                        <img src="{{ asset('storage/default-image.jpg') }}" alt="Default Image" class="object-cover w-full h-56 mx-auto">
                      @endif
                    </a>
                  </div>
                  <div class="p-3">
                    <div class="flex items-center justify-between gap-2 mb-2">
                      <h3 class="text-xl font-medium dark:text-gray-400">
                        {{ $product->name }}
                      </h3>
                    </div>
                    <p class="text-lg">
                      <span class="text-green-600 dark:text-green-600">{{ Number::currency($product->price, 'USD') }}</span>
                    </p>
                  </div>
                  <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                    <a wire:click.prevent='addToCart({{ $product->id }})' href="#" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <!-- pagination start -->
          <div class="flex justify-end mt-6">
            <nav aria-label="page-navigation">
              <ul class="flex list-style-none">
                @if ($products->onFirstPage())
                  <li class="page-item disabled">
                    <a href="#" class="relative block pointer-events-none px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Previous</a>
                  </li>
                @else
                  <li class="page-item">
                    <a href="{{ $products->previousPageUrl() }}" class="relative block px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Previous</a>
                  </li>
                @endif
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                  <li class="page-item {{ $products->currentPage() == $i ? 'bg-blue-400 text-gray-100' : '' }}">
                    <a href="{{ $products->url($i) }}" class="relative block px-3 py-1.5 mr-3 text-base {{ $products->currentPage() == $i ? 'hover:text-blue-700 transition-all duration-300 hover:bg-blue-200 dark:hover:text-gray-400 dark:hover:bg-gray-700 rounded-md' : 'text-gray-700 transition-all duration-300 dark:text-gray-400 dark:hover:bg-gray-700 hover:bg-blue-100 rounded-md' }}">{{ $i }}</a>
                  </li>
                @endfor
                @if ($products->hasMorePages())
                  <li class="page-item">
                    <a href="{{ $products->nextPageUrl() }}" class="relative block px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Next</a>
                  </li>
                @else
                  <li class="page-item disabled">
                    <a href="#" class="relative block pointer-events-none px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Next</a>
                  </li>
                @endif
              </ul>
            </nav>
            {{ $products->links() }}
          </div>
          <!-- pagination end -->
        </div>
      </div>
    </div>
  </section>
</div>
