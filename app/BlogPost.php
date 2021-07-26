<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    /**
     * Список полей разрешенных для редактирования
     *
     * @var string[]
     */
    protected $fillable =
        [
            'title',
            'slug',
            'category_id',
            'excerpt',
            'content_raw',
            'is_published',
            'published_at',
            'user_id',
        ];

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
