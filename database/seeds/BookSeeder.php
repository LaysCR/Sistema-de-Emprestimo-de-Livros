<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        for($i = 0; $i < 5; $i++){
          $book = new Book();
          $book->bk_name = $faker->sentence;
          $book->bk_author = $faker->name;
          $book->bk_owner = $faker->name;
          $book->bk_pub_id = 1;
          $book->bk_description = $faker->text;
          $book->save();
        }
    }
}
