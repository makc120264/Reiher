<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BookService implements BookServiceInterface
{
    /**
     * @var BookRepositoryInterface
     */
    protected $bookRepository;

    /**
     * BookService constructor.
     *
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Get all books.
     *
     * @return Collection
     */
    public function getAllBooks(): Collection
    {
        return $this->bookRepository->all();
    }

    /**
     * Get paginated books.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedBooks(int $perPage = 15): LengthAwarePaginator
    {
        return $this->bookRepository->paginate($perPage);
    }

    /**
     * Get book by ID.
     *
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book
    {
        return $this->bookRepository->find($id);
    }

    /**
     * Get book by slug.
     *
     * @param string $slug
     * @return Book|null
     */
    public function getBookBySlug(string $slug): ?Book
    {
        return $this->bookRepository->findBySlug($slug);
    }

    /**
     * Create a new book.
     *
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book
    {
        return $this->bookRepository->create($data);
    }

    /**
     * Update a book.
     *
     * @param int $id
     * @param array $data
     * @return Book
     */
    public function updateBook(int $id, array $data): Book
    {
        return $this->bookRepository->update($id, $data);
    }

    /**
     * Delete a book.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBook(int $id): bool
    {
        return $this->bookRepository->delete($id);
    }

    /**
     * Attach categories to a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function attachCategories(int $bookId, array $categoryIds): Book
    {
        return $this->bookRepository->attachCategories($bookId, $categoryIds);
    }

    /**
     * Sync categories for a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function syncCategories(int $bookId, array $categoryIds): Book
    {
        return $this->bookRepository->syncCategories($bookId, $categoryIds);
    }

    /**
     * Detach categories from a book.
     *
     * @param int $bookId
     * @param array $categoryIds
     * @return Book
     */
    public function detachCategories(int $bookId, array $categoryIds): Book
    {
        return $this->bookRepository->detachCategories($bookId, $categoryIds);
    }
}
