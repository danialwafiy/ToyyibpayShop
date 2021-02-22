<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden">
                <div class="p-6 bg-white ">
                    @if (Session::has('success'))

                    <div class="bg-green-400 text-white p-2 rounded-lg my-3">
                        <ul>
                            <li>{{Session::get('success')}}</li>
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('error'))

                    <div class="bg-red-400 text-white p-2 rounded-lg my-3">
                        <ul>
                            <li>{{Session::get('error')}}</li>
                        </ul>
                    </div>
                    @endif
                    <div class="grid grid-cols-4 gap-5">
                        @foreach($products as $product)
                        <div class="rounded-lg shadow-lg">
                            <img src="{{$product->url}}" class="object-fill rounded-t-lg">
                            <div class="flex justify-between items-center p-2">
                                <div>
                                    <p class="mt-2 text-sm">{{$product->name}}</p>
                                    <p class="mt-2 font-semibold text-sm">RM{{$product->price}}</p>
                                </div>
                                <div>
                                    <form action="{{route('cart.store')}}" method="POST">
                                        @csrf
                                        <input name="product" value="{{$product}}" class="hidden">
                                        <button type="submit" class="bg-indigo-500 text-white rounded px-3 py-1"><i class="lni lni-cart"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>