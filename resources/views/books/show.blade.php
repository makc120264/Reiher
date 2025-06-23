<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $book->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('books.edit', $book->slug) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Books') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
                            @if ($book->cover_image)
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full h-auto rounded shadow">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded shadow">
                                    <span class="text-gray-500">{{ __('No Cover Image') }}</span>
                                </div>
                            @endif

                            <div class="mt-4">
                                <h3 class="text-lg font-semibold mb-2">{{ __('Categories') }}</h3>
                                <div class="flex flex-wrap">
                                    @forelse ($book->categories as $category)
                                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                            <a href="{{ route('categories.show', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                        </span>
                                    @empty
                                        <span class="text-gray-500">{{ __('No categories assigned') }}</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-2xl font-bold mb-4">{{ $book->title }}</h3>

                            @if ($book->description)
                                <div class="mb-4">
                                    <h4 class="text-lg font-semibold mb-2">{{ __('Description') }}</h4>
                                    <p class="text-gray-700">{{ $book->description }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                @if ($book->author)
                                    <div>
                                        <h4 class="font-semibold">{{ __('Author') }}</h4>
                                        <p>{{ $book->author }}</p>
                                    </div>
                                @endif

                                @if ($book->publisher)
                                    <div>
                                        <h4 class="font-semibold">{{ __('Publisher') }}</h4>
                                        <p>{{ $book->publisher }}</p>
                                    </div>
                                @endif

                                @if ($book->published_date)
                                    <div>
                                        <h4 class="font-semibold">{{ __('Published Date') }}</h4>
                                        <p>{{ $book->published_date->format('F j, Y') }}</p>
                                    </div>
                                @endif

                                @if ($book->isbn)
                                    <div>
                                        <h4 class="font-semibold">{{ __('ISBN') }}</h4>
                                        <p>{{ $book->isbn }}</p>
                                    </div>
                                @endif

                                @if ($book->pages)
                                    <div>
                                        <h4 class="font-semibold">{{ __('Pages') }}</h4>
                                        <p>{{ $book->pages }}</p>
                                    </div>
                                @endif

                                @if ($book->price)
                                    <div>
                                        <h4 class="font-semibold">{{ __('Price') }}</h4>
                                        <p>${{ number_format($book->price, 2) }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6 flex justify-between items-center">
                                <div>
                                    <span class="text-sm text-gray-500">{{ __('Created') }}: {{ $book->created_at->format('M d, Y H:i') }}</span>
                                    @if ($book->updated_at && $book->updated_at->ne($book->created_at))
                                        <span class="text-sm text-gray-500 ml-4">{{ __('Updated') }}: {{ $book->updated_at->format('M d, Y H:i') }}</span>
                                    @endif
                                </div>
                                <form action="{{ route('books.destroy', $book->slug) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this book?') }}');">
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
        </div>
    </div>
</x-app-layout>
