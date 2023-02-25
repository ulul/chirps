<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message'
    ];

    /**
     * Relationship to users table
     *
     * @return BelongsTo
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
