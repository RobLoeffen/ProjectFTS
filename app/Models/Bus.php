<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bus extends Model
{
    use hasFactory;

    protected $fillable = [
        'departure_location',
        'price',
        'festival_id'
    ];

    public function festivals(): BelongsToMany {
        return $this->belongsToMany(Festival::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
