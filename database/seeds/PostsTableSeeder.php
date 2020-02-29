<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Someline\Models\Foundation\Post;
use Someline\Models\Foundation\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('posts')->truncate();
        Schema::enableForeignKeyConstraints();
        //补userid
        $users = User::all();
        foreach ($users as $user){
            //way 1

            factory(Post::class, 2)->create()->each(function ($post) use ($user) {
                    $post->user_id = $user->getUserId();
                    $post->save();
            });

            //way 2
            $post = factory(Post::class, 2)->make();
            $user->posts()->saveMany($post);

        }
    }
}
