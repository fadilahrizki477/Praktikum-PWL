<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::match(['put', 'patch'], '/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('category');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::match(['put', 'patch'], '/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Bookshelfs
    Route::get('/bookshelfs', [BookshelfController::class, 'index'])->name('bookshelf');
    Route::get('/bookshelfs/create', [BookshelfController::class, 'create'])->name('bookshelf.create');
    Route::post('/bookshelfs', [BookshelfController::class, 'store'])->name('bookshelf.store');
    Route::get('/bookshelfs/{id}/edit', [BookshelfController::class, 'edit'])->name('bookshelf.edit');
    Route::match(['put', 'patch'], '/bookshelfs/{id}', [BookshelfController::class, 'update'])->name('bookshelf.update');
    Route::delete('/bookshelfs/{id}', [BookshelfController::class, 'destroy'])->name('bookshelf.destroy');

    // Books
    Route::get('/books', [BookController::class, 'index'])->name('book');
    Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/books', [BookController::class, 'store'])->name('book.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::match(['put', 'patch'], '/books/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/books/print', [BookController::class, 'print'])->name('book.print');
    Route::get('/books/export', [BookController::class, 'export'])->name('book.export');
    Route::post('/books/import', [BookController::class, 'import'])->name('book.import');

    // Loans
    Route::get('/loans', [LoanController::class, 'index'])->name('loan');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loan.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loan.store');
    Route::get('/loans/{id}/edit', [LoanController::class, 'edit'])->name('loan.edit');
    Route::match(['put', 'patch'], '/loans/{id}', [LoanController::class, 'update'])->name('loan.update');
    Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loan.destroy');

    // Loan Details
    Route::get('/loan-details', [LoanDetailController::class, 'index'])->name('loan-detail');
    Route::get('/loan-details/create', [LoanDetailController::class, 'create'])->name('loan-detail.create');
    Route::post('/loan-details', [LoanDetailController::class, 'store'])->name('loan-detail.store');
    Route::get('/loan-details/{id}/edit', [LoanDetailController::class, 'edit'])->name('loan-detail.edit');
    Route::match(['put', 'patch'], '/loan-details/{id}', [LoanDetailController::class, 'update'])->name('loan-detail.update');
    Route::delete('/loan-details/{id}', [LoanDetailController::class, 'destroy'])->name('loan-detail.destroy');

    // Returns
    Route::get('/returns', [ReturnController::class, 'index'])->name('return');
    Route::get('/returns/create', [ReturnController::class, 'create'])->name('return.create');
    Route::post('/returns', [ReturnController::class, 'store'])->name('return.store');
    Route::get('/returns/{id}/edit', [ReturnController::class, 'edit'])->name('return.edit');
    Route::match(['put', 'patch'], '/returns/{id}', [ReturnController::class, 'update'])->name('return.update');
    Route::delete('/returns/{id}', [ReturnController::class, 'destroy'])->name('return.destroy');
});

require __DIR__ . '/auth.php';
