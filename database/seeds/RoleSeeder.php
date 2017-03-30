<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Role();
        $admin = new Role();

        $user->rle_name = 'user';
        $admin->rle_name = 'admin';

        $user->save();
        $admin->save();
    }
}
