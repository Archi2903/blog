<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    /**
     * Категории статьи
     *
     * @return BelongsTo
     */
    public function category()
    {
        // Статья принадлежит модели BlogCategory
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Авторы статьи
     *
     * @return BelongsTo
     */
    public function user()
    {
        // Статья принадлежит модели User
        return $this->belongsTo(User::class);
    }
}
