<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersRolesPermissionsSeeder::class);
        $this->call(CategoriesTableSeeder::class);




    }
}
