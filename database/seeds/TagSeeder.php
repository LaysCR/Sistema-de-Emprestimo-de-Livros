<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');
        for($i = 0; $i < 8; $i++) {
          $tag = new Tag();
          $tag->tg_name = $faker->colorName;
          $tag->save();
        }
    }
}
