<?php

class PagesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Sitec\Siravel\Models\Page::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'siravel/pages');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('pages');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'siravel/pages/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'siravel/pages/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('page');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $pages = factory(\Sitec\Siravel\Models\Page::class)->make(['id' => 2]);
        $response = $this->call('POST', 'siravel/pages', $pages['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'siravel/pages/search', ['term' => 'wtf']);

        $response->assertViewHas('pages');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $page = ['id' => 6, 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'siravel/pages', $page);

        $response = $this->call('PATCH', 'siravel/pages/6', [
            'title' => 'smarter',
            'url' => 'smart',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('pages', ['title' => 'smarter']);
    }

    public function testUpdateTranslation()
    {
        $page = ['id' => 6, 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'siravel/pages', $page);

        $response = $this->call('PATCH', 'siravel/pages/6', [
            'title' => 'smarter',
            'url' => 'smart',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Sitec\\Siravel\\Models\\Page',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'siravel/pages/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('siravel/pages');
    }
}
