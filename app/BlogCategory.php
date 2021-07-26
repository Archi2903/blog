<?php

namespace App;

use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    const ROOT = 1;
    // обязательно прописываем для свойства fill в CategoryController свойства update
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * Получить родительскую категорию
     * @return BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Пример Accessor
     * @return HigherOrderBuilderProxy|mixed|string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory()->title
            ?? ($this->isRoot()
                ? 'Корень'
                : '???');
        return $title;
    }

    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }

//    /**
//     * Пример Аксессора
//     * @param $valueFromObject
//     * @return array|false|string|string[]|null
//     */
//    public function getTitleAttribute($valueFromObject)
//    {
//        return mb_strtoupper($valueFromObject);
//    }
//
//    /**
//     * Пример мутатора
//     * @param $incomingValue
//     */
//    public function setTitleAttribute($incomingValue)
//    {
//        $this->attributes['title']=mb_strtolower($incomingValue);
//    }
}
