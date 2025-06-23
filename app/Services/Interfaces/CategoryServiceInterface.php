<?php

namespace App\Services\Interfaces;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    /**
     * Get all categories.
     *
     * @return Collection
     */
    public function getAllCategories(): Collection;

    /**
     * Get paginated categories.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedCategories(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get category by ID.
     *
     * @param int $id
     * @return Category|null
     */
    public function getCategoryById(int $id): ?Category;

    /**
     * Get category by slug.
     *
     * @param string $slug
     * @return Category|null
     */
    public function getCategoryBySlug(string $slug): ?Category;

    /**
     * Create a new category.
     *
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category;

    /**
     * Update a category.
     *
     * @param int $id
     * @param array $data
     * @return Category
     */
    public function updateCategory(int $id, array $data): Category;

    /**
     * Delete a category.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id): bool;

    /**
     * Get books for a category.
     *
     * @param int $categoryId
     * @return Collection
     */
    public function getBooks(int $categoryId): Collection;

    /**
     * Get paginated books for a category.
     *
     * @param int $categoryId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedBooks(int $categoryId, int $perPage = 15): LengthAwarePaginator;
}
