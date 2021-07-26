<?php

namespace App\Repository;

use Illuminate\Contracts\Foundation\Application;

/**
 * Class CoreRepository
 * @package App\Repository
 * 2вида Репозиторий
 * - набор запросов к выбранной таблице БД(DAO паттерн))
 * - Generic Repository абстрагирование от конкретного ORM
 *
 * Репозиторий работы с сущностью.
 * Может выдавать наборы данных.
 * Не может создавать/изменять сущности
 */
abstract class CoreRepository
{
    /**
     * @var Application|mixed
     */
    protected $model;

    /**
     * CoreRepository constructor.
     *
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
