<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * CategoryRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Find category by slug.
     *
     * @param string $slug
     * @return Category|null
     */
    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get books for a category.
     *
     * @param int $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBooks(int $categoryId)
    {
        $category = $this->find($categoryId);
        return $category->books;
    }

    /**
     * Get paginated books for a category.
     *
     * @param int $categoryId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedBooks(int $categoryId, int $perPage = 15)
    {
        $category = $this->find($categoryId);
        return $category->books()->paginate($perPage);
    }
}
