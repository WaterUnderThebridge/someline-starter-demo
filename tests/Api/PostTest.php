<?php

namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Someline\Models\Foundation\Post;

class PostTest extends BaseApiTestCase
{

    public function testGetAllPosts()
    {
        $this->withOAuthTokenTypePassword();
        $this->getApi('posts');
        $this->printResponseData();
        $this->assertJsonStructure([
            'data' => [
                '*' => [
                    'post_id',
                    'title',
                    'body',
                    'is_recommended'
                ],
            ]
        ]);
    }

    public function testGetCurrentPost()
    {
        $this->withOAuthTokenTypePassword();
        $this->getApi('posts/me');
        $this->printResponseData();
        $this->assertResponseOk();
    }

    public function testGetSinglePost()
    {
        $this->withOAuthTokenTypePassword();
        $this->getApi('posts/1');
        $this->assertResponseOk();
    }

    public function testCreatePost()
    {
        $this->withOAuthTokenTypePassword();
        $this->postApi('posts', [
            'title' =>'test title',
            'body' =>str_repeat('test body',10),
            'is_recommended'=>true
        ]);
        $this->printResponseData();
        $this->assertResponseOk();
        //$this->assertResponseUnprocessableEntity(self::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdatePost()
    {
        $this->withOAuthTokenTypePassword();
        $this->putApi('posts/207', [
            'title' => 'Harry Potter is tony',
            'body' => str_repeat('test body',10),
        ]);
        $this->printResponseData();
        $this->assertResponseNoContent();
    }

    public function testDeletePost()
    {
        $post = Post::find(3);
        if (!$post) {
            $p = factory(Post::class, 1)->make();
            $p->post_id = 3;
            $p=$p->toArray();
            //print_r($p);
            //Post::create($p[0]);
            Post::insert($p);
        }

        $this->withOAuthTokenTypePassword();
        $this->deleteApi('posts/3');
        $this->printResponseData();
        $this->assertStatus(self::HTTP_NOT_FOUND);
    }

}
