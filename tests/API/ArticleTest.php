<?php

namespace Tests\API;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class ArticleTest extends TestCase
{
    /**
     * Test get all articles
     *
     * @return void
     * @throws \Exception
     */
    public function testGetAllArticles()
    {
        $response = $this->auth()->get(api_route('articles.list', [
            'include' => 'deleted_at'
        ]));

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'title', 'summary', 'content', 'views', 'published_at', 'created_at', 'updated_at',
                ]
            ]
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }


    /**
     * Test get the specified article
     *
     * @return void
     * @throws \Exception
     */
    public function testGetSpecifiedArticle()
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $response = $this->auth()->get(api_route('articles.show', $article->getKey()));

        $response->assertJsonStructure([
            'data' => [
                'id', 'title', 'summary', 'content', 'views', 'published_at', 'created_at', 'updated_at',
            ]
        ]);
        $this->assertEquals($article->getTitle(), $response->json()['data']['title']);
        $response->assertStatus(Response::HTTP_OK);
    }


    /**
     * Test create a article
     *
     * @return void
     * @throws \Exception
     */
    public function testCreateArticle()
    {
        /** @var Article $article */
        $article = factory(Article::class)->make();
        $response = $this->auth()->post(api_route('articles.store'), $article->toArray());

        $response->assertSuccessful();

        $this->assertTrue(Article::whereTitle($article->getTitle())->exists(), 'The article does not exist after created the article.');
    }


    /**
     * Test update the specified article
     *
     * @return void
     * @throws \Exception
     */
    public function testUpdateArticle()
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();
        $title = 'A new article title';

        $response = $this->auth()->put(api_route('articles.update', $article->getKey()), [
            'title' => $title,
            'email' => $article->getTitle()
        ]);

        $response->assertSuccessful();

        $article->refresh();
        $this->assertEquals($article->getTitle(), $title);
    }


    /**
     * Test destroy the specified article
     *
     * @return void
     * @throws \Exception
     */
    public function testDestroyArticle()
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $response = $this->auth()->delete(api_route('articles.destroy', $article->getKey()));

        $response->assertSuccessful();
        $this->assertFalse(Article::whereKey($article->getKey())->exists());
    }


    /**
     * Test destroy the many articles
     *
     * @return void
     * @throws \Exception
     */
    public function testDestroyManyArticles()
    {
        /** @var Collection $articles */
        $articles = factory(Article::class, 10)->create();

        $response = $this->auth()->delete(api_route('articles.destroy_many', [
            'ids' => $articles->modelKeys()
        ]));

        $response->assertSuccessful();
        $this->assertFalse(Article::whereKey($articles->modelKeys())->exists());
    }
}
