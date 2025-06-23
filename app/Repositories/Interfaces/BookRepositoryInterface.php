<?php

namespace App\Repositories\Interfaces;

use App\Models\Book;

interface BookRepositoryInterface extends RepositoryInterface
{
    /**
     * Find book by slug.
     *
     * @param string $slug
     * @return Book|null
     */
    public function findBySlug(string $slug);

    /**
     * Attach categories to a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function attachCategories(int $bookId, array $categoryIds);

    /**
     * Sync categories for a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function syncCategories(int $bookId, array $categoryIds);

    /**
     * Detach categories from a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function detachCategories(int $bookId, array $categoryIds);
}
