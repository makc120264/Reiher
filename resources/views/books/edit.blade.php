<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Book') }}: {{ $book->title }}
            </h2>
            <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back to Books') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('books.update', $book->slug) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Title') }}:</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" required>
                            @error('title')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Slug') }}:</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $book->slug) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('slug') border-red-500 @enderror" required>
                            @error('slug')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description') }}:</label>
                            <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="author" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Author') }}:</label>
                            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('author') border-red-500 @enderror">
                            @error('author')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="publisher" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Publisher') }}:</label>
                            <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('publisher') border-red-500 @enderror">
                            @error('publisher')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="published_date" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Published Date') }}:</label>
                            <input type="date" name="published_date" id="published_date" value="{{ old('published_date', $book->published_date ? $book->published_date->format('Y-m-d') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('published_date') border-red-500 @enderror">
                            @error('published_date')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2">{{ __('ISBN') }}:</label>
                            <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('isbn') border-red-500 @enderror">
                            @error('isbn')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pages" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Pages') }}:</label>
                            <input type="number" name="pages" id="pages" value="{{ old('pages', $book->pages) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pages') border-red-500 @enderror">
                            @error('pages')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Price') }}:</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $book->price) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror">
                            @error('price')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Cover Image URL') }}:</label>
                            <input type="text" name="cover_image" id="cover_image" value="{{ old('cover_image', $book->cover_image) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cover_image') border-red-500 @enderror">
                            @error('cover_image')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Categories') }}:</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach ($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}" class="mr-2" {{ in_array($category->id, old('categories', $bookCategories)) ? 'checked' : '' }}>
                                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('categories')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Update Book') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-generate slug from title if slug is empty
        document.getElementById('title').addEventListener('input', function() {
            const slugField = document.getElementById('slug');
            if (slugField.value === '') {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugField.value = slug;
            }
        });
    </script>
</x-app-layout>
