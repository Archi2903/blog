<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Carbon\Carbon;

/**
 * Коллекции - набор
 * Class DiggingDeeperController
 * @package App\Http\Controllers
 */
class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();
//        dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        $collection = collect($eloquentCollection->toArray());
//        dd(
//            get_class($eloquentCollection),
//            get_class($collection),
//            $collection
//        );
//        $result['first']=$collection->first();
//        $result['last']=$collection->last();

        $result['where']['data'] = $collection
            ->where('category_id', 1)
            ->values()
            ->keyBy('id');

//        $result['where']['count']=$result['where']['data']->count();
//        $result['where']['isEmpty']=$result['where']['data']->isEmpty();
//        $result['where']['isNotEmpty']=$result['where']['data']->isNotEmpty();
//        dd($result);
        //Условия
//        if ($result['where']['data']->isNotEmpty()){
//            //....
//        }

//        $result['where_first']=$collection
//            ->firstWhere('created_at','>','2021-01-17 01:35:11');

        //Базовая переменная не изменится. Просто вернется измененная версия
//        $result['map']['all'] = $collection->map(function (array $item) {
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//
//            return $newItem;
//        });

//        $result['map']['not_exists'] = $result['map']['all']->where('exists', '=', false);

        //Базовая переменная не изменится(трансформируется)
        $collection->transform(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);
            return $newItem;
        });

//        //Добавляет в массив данных новое значение id
//        $newItem = new \stdClass();
//        $newItem->id = 9999;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 8888;
//
//        // Вставляет выбранное значение в первую строку
//        $collection->prepend($newItem);
//        // Вставляет выбранное значение в последнию строку
//        $collection->push($newItem2);


        //Установочный элемент в начало коллекции

//        // Вывод первого значения из массива данной таблицы
//        $newItemFirst = $collection->prepend($newItem)->first();
//        // Вывод последнего значения из массива данной таблицы
//        $newItemLast = $collection->prepend($newItem2)->last();
//        // Вывод выбираемого значения из массива данной таблицы(нахождение по ключу)
//        $pulledItem = $collection->pull(10);
//        dd(compact('collection', 'newItemFirst', 'newItemLast', 'pulledItem'));

        //Фильтрация.Замена orWhere()
        $filtered = $collection->filter(function ($item) {
            $byDay = $item->created_at->isFriday();
            $byDate = $item->created_at->day == 11;

            // Не достаточно корректная запись
//            $result = $item->created_at->isFriday() && ($item->created_at->day == 11);
            $result = $byDay && $byDate;

            return $result;
        });
        //        dd(compact('filtered'));
        //Сортировка
        $sortedSimpleCollection = collect([5, 4, 3, 2, 1])->sort();
        // Сортировка значений по полю created_at
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        dd(compact('sortedSimpleCollection', 'sortedAscCollection', 'sortedDescCollection'));
    }

}
