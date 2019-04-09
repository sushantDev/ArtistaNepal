<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'user_id'          => 1,
                'slug'             => 'blog-post',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/1.jpg'
            ],
            [
                'user_id'          => 1,
                'slug'             => 'blog-post-2',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/2.jpg'
            ],
            [
                'user_id'          => 1,
                'slug'             => 'blog-post-3',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/3.jpg'
            ],
            [
                'user_id'          => 1,
                'slug'             => 'blog-post-4',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/4.jpg'
            ],
            [
                'user_id'          => 1,
                'slug'             => 'blog-post-5',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/5.jpg'
            ],
            [
                'user_id'          => 1,
                'slug'             => 'blog-post-6',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/6.jpg'
            ],
            [
                'user_id'          => 1,
                'slug'             => 'blog-post-7',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/7.jpg'
            ],
            [
                'user_id'          => 1,
                'slug'             => 'blog-post-8',
                'title'            => 'BLOG POST',
                'meta_description' => 'Cum sociis natoque penatibus',
                'content'          => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Praesent commodo arcu massa.',
                'view'             => 'post.full-width',
                'image'            => 'images/post/8.jpg'
            ]
        ];

        foreach ($posts as $newPost)
        {
            $post = \App\Post::firstOrCreate(array_except($newPost, [ 'image' ]));
//            $size = filesize(public_path('storage/'.$newPost['image']));
            $post->image()->firstOrCreate([
                'name' => $post->slug,
                'path' => $newPost['image'],
                'size' => 0
            ]);
        }
    }
}
