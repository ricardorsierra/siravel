<?php

class WidgetsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Sitec\Siravel\Models\Widget::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'siravel/widgets');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('widgets');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'siravel/widgets/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'siravel/widgets/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('widgets');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $widgets = factory(\Sitec\Siravel\Models\Widget::class)->make(['id' => 2]);
        $response = $this->call('POST', 'siravel/widgets', $widgets['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $widget = ['id' => 8, 'name' => 'dumber', 'slug' => 'dumber'];
        $response = $this->call('POST', 'siravel/widgets', $widget);

        $response = $this->call('PATCH', 'siravel/widgets/8', [
            'name' => 'whacky',
            'slug' => 'whacky',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('widgets', ['name' => 'whacky']);
    }

    public function testUpdateTranslation()
    {
        $widget = ['id' => 8, 'name' => 'dumber', 'slug' => 'dumber'];
        $response = $this->call('POST', 'siravel/widgets', $widget);

        $response = $this->call('PATCH', 'siravel/widgets/8', [
            'name' => 'whacky',
            'slug' => 'whacky',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Sitec\\Siravel\\Models\\Widget',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'siravel/widgets/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('siravel/widgets');
    }
}
