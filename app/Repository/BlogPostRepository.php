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
            ->orderBy('id', 'DESC') // сортировка id по методу DESC то новые сначала
//                ->with(['category', 'user']) // для оптимизации запроса,чтобы сортировка шла только по выбранным полям
            ->with([
                // второй вариант опитимизации
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                // можно короче
                'user:id,name',
            ])
            ->paginate(25);

        return $result;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {
        $colums = implode(',', [
            'id',
            'CONCAT (id, ". ", title) AS title',
        ]);

//        $result[]=$this->startConditions()->all();
        return $this
            ->startConditions()
            ->selectRaw($colums)
            ->toBase()
            ->get();
    }
}
