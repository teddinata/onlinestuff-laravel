<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product &raquo; Create
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
                <form method="POST" action="{{ route('product.store') }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                            <input type="text" name="name" id="name" placeholder="Product Name" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') focus:border-gray-500 @enderror" value="{{ old('name') }}">
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label for="tags" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tags</label>
                            <input type="text" name="tags" id="tags" placeholder="Product Tags" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg @error('tags') focus:border-gray-500 @enderror" value="{{ old('tags') }}">
                            <p class="text-gray-600 text-xs italic">Comma separated, e.g: tag1, tag2, tag3</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="weight" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Weight</label>
                            <input type="number" name="weight" id="weight" placeholder="Weight" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg @error('weight') focus:border-gray-500 @enderror" value="{{ old('weight') }}">
                            <p class="text-gray-600 text-xs italic">Optional</p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="stock" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Stock</label>
                            <input type="number" name="stock" id="stock" placeholder="Product Stock" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500">
                        </div>


                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3">
                            <label for="category_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Category</label>
                            <select name="category_id" id="category_id" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Status</label>
                            <select name="status" id="status" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Description</label>
                            <textarea id="editor" name="description" class="description appereance-none block w-full bg-gray-100 border-2 border-gray-100 focus:outline-none focus:bg-white p-4 rounded-lg @error('description') focus:border-gray-500 @enderror" placeholder="Product Description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="price" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Price</label>
                            <input type="number" name="price" id="price" placeholder="Product Price" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500 @error('price')@enderror" value="{{ old('price') }}">

                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="discount_price" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Discount Price</label>
                            <input type="number" name="discount_price" id="discount_price" placeholder="Discount Price" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500 @error('discount_price')@enderror" value="{{ old('discount_price') }}">
                            <p class="text-gray-600 text-sm italic">Optional</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">

                            <label for="video_url" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Video URL</label>
                            <input type="text" name="video_url" id="video_url" placeholder="Video URL" class="appereance-none block leading-tight focus:outline-none focus:bg-white bg-gray-100 border-2 w-full p-4 rounded-lg focus:border-gray-500" value="{{ old('video_url') }}">
                        </div>
                    </div>


                    <!-- Add more fields for the product model here -->

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
