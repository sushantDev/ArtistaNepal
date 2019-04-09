<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
//    $this->call(SettingsTableSeeder::class);
    $this->call(PostsTableSeeder::class);
    $this->call(TagsTableSeeder::class);
    $this->call(EventsTableSeeder::class);
  }
}