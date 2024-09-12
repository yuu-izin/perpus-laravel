<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'address',
        'phone',
    ];

    // Relasi One To One
    public function user()
    {
        return $this->hasOne(Userprofiles::class, 'profile_id');
    }
}
