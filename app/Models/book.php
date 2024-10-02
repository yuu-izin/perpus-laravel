<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_code_id',
        'title',
        'description',
        'year',
        'publisher',
        'category_id',
        'book_shelf_id',
    ];

    public function bookCode()
    {
        return $this->belongsTo(BookCode::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelfs::class, 'book_shelf_id');
    }
}
