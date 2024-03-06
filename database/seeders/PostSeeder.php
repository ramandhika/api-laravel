<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'Post 1',
                'news_content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quae odit iusto alias possimus necessitatibus ab ut repellat magni magnam? Sed neque eum eaque ad praesentium unde recusandae ducimus porro.',
                'author' => '1',
            ],
            [
                'id' => 2,
                'title' => 'Post 2',
                'news_content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quae odit iusto alias possimus necessitatibus ab ut repellat magni magnam? Sed neque eum eaque ad praesentium unde recusandae ducimus porro.',
                'author' => '2',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
