<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;
// обязательно прописываем для свойства fill в CategoryController свойства update
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];
}
