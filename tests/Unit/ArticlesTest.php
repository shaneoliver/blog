<?php

namespace Tests\Unit;

use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function has_a_title()
    {
        $article = factory(Article::class)->create([
            'title' => 'My title',
        ]);

        $this->assertEquals('My title', $article->title);  
    }
    
}
