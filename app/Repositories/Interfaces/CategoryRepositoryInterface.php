<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Find category by slug.
     *
     * @param string $slug
     * @return Category|null
     */
    public function findBySlug(string $slug);

    /**
     * Get books for a category.
     *
     * @param int $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBooks(int $categoryId);

    /**
     * Get paginated books for a category.
     *
     * @param int $categoryId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedBooks(int $categoryId, int $perPage = 15);
}
