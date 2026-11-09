<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['reviewer_name', 'rating', 'body'];

    protected function casts(): array
    {
        return ['rating'=>'integer'];
    }

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
}
