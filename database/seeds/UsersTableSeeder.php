<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // create user
        $user = App\User::create([
            'name'     => 'ArtistaNepal Admin',
            'username' => str_slug('Artista Nepal Admin'),
            'email'    => 'admin@artistanepal.com',
            'password' => bcrypt('secret')
        ]);

        $user->assignRole('admin');
    }
}
