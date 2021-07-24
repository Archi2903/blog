<?php

namespace App\Observers;

use App\BlogPost;
use Carbon\Carbon;


class BlogPostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        $test[]=$blogPost->isDirty();
        $test[]=$blogPost->isDirty('is_published');
        $test[]=$blogPost->isDirty('user_id');
        $test[]=$blogPost->getAttribute('is_published');
        $test[]=$blogPost->is_published;
        $test[]=$blogPost->getOriginal('is_published');
        dd($test);
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }

    /**
     * Если дата публикации не установлена и происходит установка флага - Опубликовано,
     * то устанавливаем дату публикации на текущую
     *
     * @param BlogPost $blogPost
     */
    public function setPublishedAt(BlogPost $blogPost)
    {
        if (empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Если поле слаг пустое,то заполняем его конвертацией заголовка
     *
     * @param BlogPost $blogPost
     */
    public function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
