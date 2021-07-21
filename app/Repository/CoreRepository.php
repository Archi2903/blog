<?php

namespace App\Repository;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 * @package App\Repository
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