<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function buses(): HasMany {
        return $this->hasMany(Bus::class);
    }
}
