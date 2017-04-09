<?php

class LinksTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Sitec\Siravel\Models\Link::class)->create();
        factory(\Sitec\Siravel\Models\Link::class)->make(['id' => 1]);
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testCreate()
    {
        $response = $this->call('GET', '/siravel/links/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', '/siravel/links/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('links');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $link = factory(\Sitec\Siravel\Models\Link::class)->make(['id' => 89]);
        $response = $this->call('POST', '/siravel/links', $link['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/siravel/menus/1/edit');
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', '/siravel/links/1', [
            'name' => 'wtf',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', '/siravel/links/1');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
