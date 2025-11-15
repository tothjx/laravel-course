<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'email',
        'article_title',
        'article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
