<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
  /**
   * Run the Setting model database seed.
   *
   * @return void
   */
  public function run()
  {
    $settings = [
      [
        'slug'  => 'title',
        'value' => 'Artista Nepal'
      ],
      [
        'slug'  => 'description',
        'value' => ''
      ],
      [
        'slug'  => 'address',
        'value' => 'Lalitpur, Nepal',
      ],
      [
        'slug'  => 'phone',
        'value' => '9843228246',
      ],
      [
        'slug'  => 'email',
        'value' => 'info@artistanepal.com'
      ],
      [
        'slug'  => 'postbox',
        'value' => ''
      ],
      [
        'slug'  => 'facebook',
        'value' => 'https://www.facebook.com'
      ],
      [
        'slug'  => 'twitter',
        'value' => 'https://www.twitter.com'
      ],
      [
        'slug'  => 'google_plus',
        'value' => 'https://www.google.com'
      ],
      [
        'slug'  => 'logo',
        'value' => '/img/logo.png'
      ],
      [
        'slug'  => 'notification-emails',
        'value' => 'admin@gyanodaya.edu.np'
      ],
      [
        'slug'  => 'placeholder',
        'value' => '/img/parallax.jpg'
      ]
    ];

    DB::table('settings')->truncate();

    DB::table('settings')->insert($settings);
  }
}
