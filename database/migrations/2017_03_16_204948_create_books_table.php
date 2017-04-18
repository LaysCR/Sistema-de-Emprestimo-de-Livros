<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('rbk_books', function (Blueprint $table) {
          $table->increments('bk_id');
          $table->string('bk_name');
          $table->string('bk_author');
          $table->string('bk_owner');
          $table->text('bk_description');
          $table->boolean('bk_availability');
          $table->integer('bk_pub_id')->unsigned();
          $table->timestamps();

          $table->foreign('bk_pub_id')->references('pub_id')->on('rbk_publishers');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbk_books');
    }
}
