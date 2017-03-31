<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;

class UserSeeder extends Seeder
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
        $user = new User();

        if($i == 0){
          $user->name = 'admin';
          $user->email = 'admin@admin.com';
          $user->password = bcrypt('123456');
          $user->user_rle_id = 2;
        }
        else{
          $user->name = $faker->lastName;
          $user->email = $faker->email;
          $user->password = bcrypt('123456');
          $user->user_rle_id = 1;
        }

        $user->save();
      }

    }
}
