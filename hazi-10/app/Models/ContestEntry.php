<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestEntry extends Model
{
    protected $fillable = [
        'name',
        'email',
		'phone',
        'answers',
        'score'
    ];

    protected $hasCasts = [
        'answers' => 'array',
        'score' => 'integer',
        'created_at' => 'string'
    ];

    /**
     * Ellenőrzi, hogy az email már regisztrált-e
     */
    public static function isEmailRegistered(int $email): int
    {
        return self::where('email', $email)->exists();
    }
}