<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\Interfaces\BookServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * @var BookServiceInterface
     */
    protected $bookService;

    /**
     * @var CategoryServiceInterface
     */
    protected $categoryService;

    /**
     * BookController constructor.
     *
     * @param BookServiceInterface $bookService
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(
        BookServiceInterface $bookService,
        CategoryServiceInterface $categoryService
    ) {
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the books.
     */
    public function index(): View
    {
        $books = $this->bookService->getPaginatedBooks();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create(): View
    {
        $categories = $this->categoryService->getAllCategories();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:books',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            'isbn' => 'nullable|string|max:255|unique:books',
            'pages' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'cover_image' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $book = $this->bookService->createBook($data);

        if (isset($data['categories'])) {
            $this->bookService->syncCategories($book->id, $data['categories']);
        }

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified book.
     */
    public function show(string $slug): View
    {
        $book = $this->bookService->getBookBySlug($slug);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(string $slug): View
    {
        $book = $this->bookService->getBookBySlug($slug);
        $categories = $this->categoryService->getAllCategories();
        $bookCategories = $book->categories->pluck('id')->toArray();
        return view('books.edit', compact('book', 'categories', 'bookCategories'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, string $slug): RedirectResponse
    {
        $book = $this->bookService->getBookBySlug($slug);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:books,slug,' . $book->id,
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            'isbn' => 'nullable|string|max:255|unique:books,isbn,' . $book->id,
            'pages' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'cover_image' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $this->bookService->updateBook($book->id, $data);

        if (isset($data['categories'])) {
            $this->bookService->syncCategories($book->id, $data['categories']);
        } else {
            $this->bookService->syncCategories($book->id, []);
        }

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $book = $this->bookService->getBookBySlug($slug);
        $this->bookService->deleteBook($book->id);

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
