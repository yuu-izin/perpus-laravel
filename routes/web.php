<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookshelfsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\VisitsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // route user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}/edit', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // book route
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/book/{book}/edit', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{book}', [BookController::class, 'destroy'])->name('book.destroy');

    // Members route
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
    Route::post('/member', [MemberController::class, 'store'])->name('member.store');
    Route::get('/member/{member}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::put('/member/{member}/edit', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/member/{member}', [MemberController::class, 'destroy'])->name('member.destroy');

    // facilities route
    Route::get('/facilities', [FacilitiesController::class, 'index'])->name('facilities.index');
    Route::get('/facilities/create', [FacilitiesController::class, 'create'])->name('facilities.create');
    Route::post('/facilities', [FacilitiesController::class, 'store'])->name('facilities.store');
    Route::get('/facilities/{facilities}/edit', [FacilitiesController::class, 'edit'])->name('facilities.edit');
    Route::put('/facilities/{facilities}/edit', [FacilitiesController::class, 'update'])->name('facilities.update');
    Route::delete('/facilities/{facilities}', [FacilitiesController::class, 'destroy'])->name('facilities.destroy');

    // categories route
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categories}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categories}/edit', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categories}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

    // bookshelfs route
    Route::get('/bookshelfs', [BookshelfsController::class, 'index'])->name('bookshelfs.index');
    Route::get('/bookshelfs/create', [BookshelfsController::class, 'create'])->name('bookshelfs.create');
    Route::post('/bookshelfs', [BookshelfsController::class, 'store'])->name('bookshelfs.store');
    Route::get('/bookshelfs/{bookshelfs}/edit', [BookshelfsController::class, 'edit'])->name('bookshelfs.edit');
    Route::put('/bookshelfs/{bookshelfs}/edit', [BookshelfsController::class, 'update'])->name('bookshelfs.update');
    Route::delete('/bookshelfs/{bookshelfs}', [BookshelfsController::class, 'destroy'])->name('bookshelfs.destroy');

    // visits route
    Route::get('/visits', [VisitsController::class, 'index'])->name('visits.index');
    Route::get('/visits/create', [VisitsController::class, 'create'])->name('visits.create');
    Route::post('/visits', [VisitsController::class, 'store'])->name('visits.store');
    Route::get('/visits/{visits}/edit', [VisitsController::class, 'edit'])->name('visits.edit');
    Route::put('/visits/{visits}/edit', [VisitsController::class, 'update'])->name('visits.update');
    Route::delete('/visits/{visits}', [VisitsController::class, 'destroy'])->name('visits.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
