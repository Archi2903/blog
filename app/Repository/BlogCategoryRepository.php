<?php

namespace App\Repository;

use App\BlogCategory as Model;

/**
 * Class BlogCategoryRepository
 * @package App\Repository
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     *  Получить Модель для редактирования в админке
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить список категорий для вывода в выпадающем списке
     *
     * @return mixed
     */
    public function getForComboBox()
    {
//        return $this->startConditions()->all();

        $colums = implode(',', [
            'id',
            'CONCAT (id, ". ", title) AS title',
        ]);

//        $result[]=$this->startConditions()->all();
//        $result[]=$this
//            ->startConditions()
//            ->select('blog_categories.*',
//            \DB::raw('CONCAT (id,". ", title) AS id_title'))
//            ->toBase()
//            ->get();
        return $this
            ->startConditions()
            ->selectRaw($colums)
            ->toBase()
            ->get();
    }

    /**
     * Получить категории с выводом пагинатора
     *
     * @param null $perPage
     * @return mixed
     */
    public function getAllWithPaginate($perPage = null)
    {
        $colums = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($colums)
            ->with([
                'parentCategory:id,title'
            ])
            ->paginate($perPage);

        return $result;
    }


}
