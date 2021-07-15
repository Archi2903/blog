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
//        $this->call(UsersTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        factory(User::class,2)->create();
        factory(BlogPost::class,100)->create();
//
    }
}
