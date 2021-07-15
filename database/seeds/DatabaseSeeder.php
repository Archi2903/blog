<?php

use Illuminate\Database\Seeder;
use App\BlogPost;
use App\User;
use App\BlogCategory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $this->call(BlogCategoriesTableSeeder::class);
        /*обязательно в такой последовательности запускаем,иначе нарушается логика построения*/
        factory(User::class, 2)->create();
        /*запускается без ошибок,только если создан User*/
        factory(BlogPost::class, 100)->create();

    }
}
