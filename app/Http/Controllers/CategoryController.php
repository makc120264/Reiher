<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @var CategoryServiceInterface
     */
    protected $categoryService;

    /**
     * CategoryController constructor.
     *
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the categories.
     */
    public function index(): View
    {
        $categories = $this->categoryService->getPaginatedCategories();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        $this->categoryService->createCategory($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(string $slug): View
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        $books = $this->categoryService->getPaginatedBooks($category->id);
        return view('categories.show', compact('category', 'books'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(string $slug): View
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, string $slug): RedirectResponse
    {
        $category = $this->categoryService->getCategoryBySlug($slug);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $this->categoryService->updateCategory($category->id, $data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        $this->categoryService->deleteCategory($category->id);

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
