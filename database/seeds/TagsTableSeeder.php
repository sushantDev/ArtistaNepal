<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'tag'              => 'news',
                'title'            => 'News',
                'subtitle'         => 'Subtitle for news',
                'meta_description' => setting('title').' News',
                'created_at'       => \Carbon\Carbon::now(),
                'updated_at'       => \Carbon\Carbon::now()
            ],
            [
                'tag'              => 'events',
                'title'            => 'Events',
                'subtitle'         => 'Subtitle for events',
                'meta_description' => setting('title').' Events',
                'created_at'       => \Carbon\Carbon::now(),
                'updated_at'       => \Carbon\Carbon::now()
            ],
            [
                'tag'              => 'hr-activities',
                'title'            => 'HR Activities',
                'subtitle'         => 'Subtitle for HR activities',
                'meta_description' => setting('title').' HR activities',
                'created_at'       => \Carbon\Carbon::now(),
                'updated_at'       => \Carbon\Carbon::now()
            ]
        ];

        foreach ($posts as $data)
        {
            DB::table('tags')->updateOrInsert($data);
        }
    }
}
