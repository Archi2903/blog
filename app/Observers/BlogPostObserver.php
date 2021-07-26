<?php

namespace App\Observers;

use App\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;


/**
 * Чтобы использовать observer нужно подключить его в App\Providers/AppServiceProvider в функции boot
 * Observer - нужен для обработки записей перед CRUD операциями, убрать из контроллеров лишнюю логику
 * Class BlogPostObserver
 * @package App\Observers
 */
class BlogPostObserver
{
    /**
     * Обработка перед созданием Поста
     * @param BlogPost $blogPost
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHTML($blogPost);
        $this->setUser($blogPost);

    }

    /**
     * @param BlogPost $blogPost
     */
    public function created(BlogPost $blogPost)
    {
    }

    /**
     * Обработка перед обновлением поста
     * @param BlogPost $blogPost
     */
    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * @param BlogPost $blogPost
     */
    public function updated(BlogPost $blogPost)
    {
    }


    /**
     * Если дата публикации не установлена и опубликована запись,
     * то устанавливаемая дата публикации - текущее время
     * @param BlogPost $blogPost
     */
    public function setPublishedAt(BlogPost $blogPost)
    {
        $needSetPublished = empty($blogPost->published_at) && $blogPost->is_published;
        if ($needSetPublished) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Если поле слаг пустое,то заполняем его конвертацией заголовка
     * @param BlogPost $blogPost
     */
    public function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * Установка значения поля content_html после изменения content_raw
     * @param BlogPost $blogPost
     */
    public function setHTML(BlogPost $blogPost)
    {
        if ($blogPost->isDirty('content_raw')) {
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * Если не указан user_id , то прописываем по умолчанию
     * @param BlogPost $blogPost
     */
    public function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

}
