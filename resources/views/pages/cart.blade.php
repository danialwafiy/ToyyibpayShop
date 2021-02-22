<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden">
                <div class="p-6 bg-white ">
                    @forelse($carts as $cart)
                    <div class="rounded-lg border shadow-lg px-4 py-2 mb-2">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div>
                                    <img class="object-cover w-28 h-24" src="{{$cart->product->url}}">
                                </div>
                                <div class="ml-4">
                                    <p>{{$cart->product->name}}</p>
                                    <p class="font-bold">RM{{$cart->product->price}}</p>
                                </div>
                            </div>
                            <form action="/cart/{{ $cart->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="text-2xl"><i class="lni lni-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="flex mt-4 justify-end">
                        <a href="/toyyibpay" class="px-3 py-2 bg-indigo-500 text-white rounded">Checkout</a>
                    </div>
                    @empty
                    <div class="text-lg">Cart is empty.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>