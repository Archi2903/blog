<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);/* unsigned - от 0 и выше,как автоинкремент */

            $table->string('slug')->unique();/* название категории для URL и поэтому долно быть unique(уникальное id) уникальным*/
            $table->string('title');
            $table->text('description')->nullable();/* поле описания nullable не обязательно для заполнение*/

            $table->timestamps();
            $table->softDeletes();/* когда была удалени запись,при этом запись не удаляется*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}
