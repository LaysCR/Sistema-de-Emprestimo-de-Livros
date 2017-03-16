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
      Schema::create('books', function (Blueprint $table) {
          $table->increments('book_id');
          $table->string('book_name');
          $table->string('book_author');
          $table->string('book_owner');
          $table->string('book_description');
          $table->foreign('book_publisher_id')->references('publisher_id')->on('publishers');
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
        Schema::dropIfExists('books');
    }
}
