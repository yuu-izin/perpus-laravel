<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
    ];

    // relasi one to one
    public function book()
    {
        return $this->hasOne(Book::class);
    }
}
