<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('category_id')->nullable();
          $table->unsignedBigInteger('prefecture_id');
          $table->string('image');
          $table->string('image2')->nullable();
          $table->string('image3')->nullable();
          $table->string('image4')->nullable();
          $table->string('thumbnail');
          $table->string('city')->nullable();
          $table->string('title');
          $table->text('caption')->nullable();
          $table->timestamps();

          $table->index('user_id');
          $table->index('category_id');
          $table->index('prefecture_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
