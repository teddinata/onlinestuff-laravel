<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Gallery &raquo; Create
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                {{-- create error message --}}
                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 mb-4">
                        <div class="font-bold">Oops! Something went wrong.</div>
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('gallery.store') }}" class="w-full" enctype="multipart/form-data">
                    @csrf

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="product_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Product</label>
                            <select name="product_id" id="product_id" class="appearance-none block leading-tight
                            focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="image" class="sr-only block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Image</label>
                            <input type="file" name="image" id="image" class="appearance-none block leading-tight
                            focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="caption" class="sr-only block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Caption</label>
                            <textarea name="caption" id="caption" placeholder="Product caption" class="appearance-none block leading-tight
                                focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg @error('caption') focus:border-gray-500
                                @enderror">{{ old('caption') }}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 text-white px-4 py-3 rounded font-medium w-full">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
