<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id('id');

            $table->unsignedBigInteger('category_id');/*id категории к которой принадлежит пост(ссылка на другую таблицу)*/
            $table->unsignedBigInteger('user_id');/*id автора создавшего статью user_id связь с таблицой user обычно пишут author id бизнес логика*/

            $table->string('slug')->unique();
            $table->string('title');

            $table->text('excerpt')->nullable(); /* небольшая выдержка статьи немного из статьи имя автора дата*/

            $table->text('content_raw');/* сырые данные */
            $table->text('content_html');/* данные переформатированиие в html */

            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');/*Привязка колонки user_id по id к табице users */
            $table->foreign('category_id')->references('id')->on('blog_categories');

            $table->index('is_published');/*ставим index, так как мы будем по нему производить поиск ,выборку и . т .д*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
