<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /* генерирует  для BlogCategories title,slug,Родительское ID*/
    public function run()
    {
        $categories = [];
        /*Create first categories, так как ParentID у нее 0(тоесть неккоректно,то ставим No categories)  */
        $cName = 'No categories';
        $categories[] = [
            'title' => $cName,
            'slug' => Str::slug($cName, ' '),
            'parent_id' => 0,
        ];

        /*Формируем несколько категорий  ParentID must start from 1!*/
        for ($i = 1; $i <= 10; $i++) {
            /*  Names categories */
            $cName = 'Category #' . $i;
            /* Родительское ID(будет присвоено категории) от 1 до 4(будет присвоено 1ParentID),
             категориям больше 4 будет присвоено (ParentID рандом от 1 до 4)*/
            $parentID = ($i > 4) ? rand(1, 4) : 1;
            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName, ' '),
                'parent_id' => $parentID,

            ];
        }
        DB::table('blog_categories')->insert($categories);

    }
}
