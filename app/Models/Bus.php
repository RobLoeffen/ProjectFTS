<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bus extends Model
{
    use HasFactory; // Fixed typo from hasFactory to HasFactory

    protected $fillable = [
        'departure_location',
        'arrival_time',
        'departure_time',
        'price',
        'festival_id'
    ];

    public function festival(): BelongsTo {
        return $this->belongsTo(Festival::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
