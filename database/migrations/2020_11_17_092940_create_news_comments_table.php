<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_news_id');
            $table->unsignedBigInteger('user_id');

            $table->string('comment');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at');

            $table->softDeletes();

            $table->foreign('parent_news_id')->references('id')->on('news');
            //category_id = id из таблицы blog_categories
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_comments');
    }
}
