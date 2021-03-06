<?php

namespace App\Observers;

use App\BlogCategory;
use Illuminate\Support\Str;

/**
 * Чтобы использовать observer нужно подключить его в App\Providers/AppServiceProvider в функции boot
 * Observer - нужен для обработки записей перед ибо после CRUD операций, убрает из контроллеров лишнюю логику
 * Class BlogCategoryObserver
 * @package App\Observers
 */
class BlogCategoryObserver
{

    /**
     * Предустановка перед созданием category
     * @param BlogCategory $blogCategory
     */
    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Прописывает title, если slug пустой при заполнении
     * @param BlogCategory $blogCategory
     */
    protected function setSlug(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }

    /**
     * Handle the blog category "created" event.
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Предустановка перед обновлением category
     * @param BlogCategory $blogCategory
     */
    public function updating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the blog category "updated" event.
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
