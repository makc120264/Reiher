<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $category->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('categories.edit', $category->slug) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Categories') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-4">{{ $category->name }}</h3>

                        @if ($category->description)
                            <div class="mb-4">
                                <h4 class="text-lg font-semibold mb-2">{{ __('Description') }}</h4>
                                <p class="text-gray-700">{{ $category->description }}</p>
                            </div>
                        @endif

                        <div class="mt-4">
                            <span class="text-sm text-gray-500">{{ __('Created') }}: {{ $category->created_at->format('M d, Y H:i') }}</span>
                            @if ($category->updated_at && $category->updated_at->ne($category->created_at))
                                <span class="text-sm text-gray-500 ml-4">{{ __('Updated') }}: {{ $category->updated_at->format('M d, Y H:i') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">{{ __('Books in this Category') }}</h3>

                        @if ($books->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($books as $book)
                                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                        <div class="p-4">
                                            <h4 class="font-semibold text-lg mb-2">
                                                <a href="{{ route('books.show', $book->slug) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $book->title }}
                                                </a>
                                            </h4>

                                            @if ($book->author)
                                                <p class="text-gray-600 mb-2">{{ __('By') }}: {{ $book->author }}</p>
                                            @endif

                                            @if ($book->description)
                                                <p class="text-gray-700 mb-3 line-clamp-3">{{ Str::limit($book->description, 150) }}</p>
                                            @endif

                                            <div class="flex justify-between items-center mt-4">
                                                @if ($book->price)
                                                    <span class="font-bold">${{ number_format($book->price, 2) }}</span>
                                                @endif
                                                <a href="{{ route('books.show', $book->slug) }}" class="text-blue-500 hover:text-blue-700">
                                                    {{ __('View Details') }} →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6">
                                {{ $books->links() }}
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('No books found in this category.') }}</p>
                        @endif
                    </div>

                    <div class="mt-8 flex justify-between items-center">
                        <div></div>
                        <form action="{{ route('categories.destroy', $category->slug) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
