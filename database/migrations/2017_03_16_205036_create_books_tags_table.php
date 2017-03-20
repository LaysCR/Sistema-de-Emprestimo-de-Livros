<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('rbk_books_tags', function (Blueprint $table) {
          $table->increments('bt_id');
          $table->integer('bt_bk_id')->unsigned();
          $table->integer('bt_tg_id')->unsigned();
          $table->foreign('bt_bk_id')->references('bk_id')->on('rbk_books');
          $table->foreign('bt_tg_id')->references('tg_id')->on('rbk_tags');
          $table->rememberToken();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbk_books_tags');
    }
}
