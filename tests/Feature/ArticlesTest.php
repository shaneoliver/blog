<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function guest_can_view_published_article()
    {
        $article = factory(Article::class)->state('published')->create();

        $response = $this->get(route('article.show', $article));

        $response->assertStatus(200);
    }

    /** @test */
    public function guest_cannot_view_unpublished_article()
    {
        $article = factory(Article::class)->state('unpublished')->create();

        $response = $this->get(route('article.show', $article));

        $response->assertStatus(403);
    }

    /** @test */
    public function admins_can_view_all_articles()
    {
        $this->be(factory(User::class)->create([
            'admin' => true,
        ]));

        $publishedArticle = factory(Article::class)->state('published')->create();
        $unpublishedArticle = factory(Article::class)->state('unpublished')->create();

        $this->get(route('article.show', $publishedArticle))
            ->assertStatus(200);
        $this->get(route('article.show', $unpublishedArticle))
            ->assertStatus(200);
    }    
}
