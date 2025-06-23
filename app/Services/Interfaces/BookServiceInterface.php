<?php

namespace App\Services\Interfaces;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BookServiceInterface
{
    /**
     * Get all books.
     *
     * @return Collection
     */
    public function getAllBooks(): Collection;

    /**
     * Get paginated books.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedBooks(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get book by ID.
     *
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book;

    /**
     * Get book by slug.
     *
     * @param string $slug
     * @return Book|null
     */
    public function getBookBySlug(string $slug): ?Book;

    /**
     * Create a new book.
     *
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book;

    /**
     * Update a book.
     *
     * @param int $id
     * @param array $data
     * @return Book
     */
    public function updateBook(int $id, array $data): Book;

    /**
     * Delete a book.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBook(int $id): bool;

    /**
     * Attach categories to a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function attachCategories(int $bookId, array $categoryIds): Book;

    /**
     * Sync categories for a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function syncCategories(int $bookId, array $categoryIds): Book;

    /**
     * Detach categories from a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function detachCategories(int $bookId, array $categoryIds): Book;
}
