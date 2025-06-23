<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    /**
     * BookRepository constructor.
     *
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    /**
     * Find book by slug.
     *
     * @param string $slug
     * @return Book|null
     */
    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Attach categories to a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function attachCategories(int $bookId, array $categoryIds)
    {
        $book = $this->find($bookId);
        $book->categories()->attach($categoryIds);
        return $book->load('categories');
    }

    /**
     * Sync categories for a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function syncCategories(int $bookId, array $categoryIds)
    {
        $book = $this->find($bookId);
        $book->categories()->sync($categoryIds);
        return $book->load('categories');
    }

    /**
     * Detach categories from a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function detachCategories(int $bookId, array $categoryIds)
    {
        $book = $this->find($bookId);
        $book->categories()->detach($categoryIds);
        return $book->load('categories');
    }
}
