<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        Checkout
    </h1>
    <div class="grid grid-cols-12 gap-4">
        <div class="md:col-span-12 lg:col-span-8 col-span-12">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <!-- Shipping Address -->
                <form action="{{ route('generate.pdf') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            Factura
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                    Nombre
                                </label>
                                <input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="first_name" name="first_name" type="text">
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                    Apellido
                                </label>
                                <input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="last_name" name="last_name" type="text">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                Teléfono
                            </label>
                            <input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="phone" name="phone" type="text">
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="address">
                                Dirección
                            </label>
                            <input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="address" name="address" type="text">
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="city">
                                Ciudad
                            </label>
                            <input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="city" name="city" type="text">
                        </div>
                    </div>
                       <!-- Campos hidden para subtotal y grand total -->
                        <input type="hidden" name="subtotal" value="{{ $grand_total }}">
                        <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                        <input type="hidden" name="item_count" value="{{ count($cart_items) }}">
                    <button type="submit" class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                        Ordenar
                    </button>
                </form>
            </div>
            <!-- End Card -->
        </div>
        <div class="md:col-span-12 lg:col-span-4 col-span-12">
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                    ORDER SUMMARY
                </div>
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        Subtotal
                    </span>
                    <span>
                        {{Number::currency($grand_total, 'USD')}}
                    </span>
                </div>
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        IVA
                    </span>
                    <span>
                        {{Number::currency(0, 'USD')}}

                    </span>
                </div>
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        Costo de envio
                    </span>
                    <span>
                        {{Number::currency(0, 'USD')}}

                    </span>
                </div>
                <hr class="bg-slate-400 my-4 h-1 rounded">
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        Total
                    </span>
                    <span>
                        {{Number::currency($grand_total, 'USD')}}

                    </span>
                </div>
                </hr>
            </div>
            <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                    BASKET SUMMARY
                </div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                @foreach($cart_items as $ci)
    <li class="py-3 sm:py-4" wire:key='{{$ci['product_id'] }}'>
        <div class="flex items-center">
            <div class="flex-shrink-0">
                @if(isset($ci['image']))
                    <img alt="{{$ci['name']}}" class="w-12 h-12 rounded-full" src="{{url('storage', $ci['image']) }}">
                @else
                    <img alt="default" class="w-12 h-12 rounded-full" src="{{url('path_to_default_image')}}">
                @endif
            </div>
            <div class="flex-1 min-w-0 ms-4">
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                    {{$ci['name'] }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    Quantity: {{ $ci['quantity']}}
                </p>
            </div>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                {{Number::currency($ci['total_amount'], 'USD')}}
            </div>
        </div>
    </li>
@endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
