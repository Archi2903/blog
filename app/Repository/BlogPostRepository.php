<?php

namespace App\Repository;

use App\BlogPost as Model;

class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить Посты с применение пагинатора(Admin)
     *
     * @param null $perPage
     * @return mixed
     */
    public function getAllWithPaginate()
    {
        $colums = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startConditions()
                       ->select($colums)
                       ->orderBy('id','DESC') // сортировка id по методу DESC то новые сначала
                       ->paginate(25);

        return $result;
    }


}
