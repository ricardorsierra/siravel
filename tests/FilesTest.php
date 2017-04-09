<?php

class FilesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Sitec\Siravel\Models\File::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'siravel/files');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('files');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'siravel/files/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'siravel/files/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('files');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/test-file.txt', 'test-file.txt');
        $file = factory(\Sitec\Siravel\Models\File::class)->make([
            'id' => 2,
            'location' => [
                'file_a' => [
                    'name' => CryptoService::encrypt('test-file.txt'),
                    'original' => 'test-file.txt',
                    'mime' => 'txt',
                    'size' => 24,
                ],
            ],
        ]);
        $response = $this->call('POST', 'siravel/files', $file->getAttributes());
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'siravel/files/search', ['term' => 'wtf']);

        $response->assertViewHas('files');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $file = (array) factory(\Sitec\Siravel\Models\File::class)->make(['id' => 3, 'title' => 'dumber']);
        $response = $this->call('PATCH', 'siravel/files/3', $file);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/siravel/files');
    }

    public function testDelete()
    {
        Storage::put('test-file.txt', 'what is this');
        $file = factory(\Sitec\Siravel\Models\File::class)->make([
            'id' => 2,
            'location' => [
                'file_a' => [
                    'name' => CryptoService::encrypt('test-file.txt'),
                    'original' => 'test-file.txt',
                    'mime' => 'txt',
                    'size' => 24,
                ],
            ],
        ]);
        $this->call('POST', 'siravel/files', $file->getAttributes());

        $response = $this->call('DELETE', 'siravel/files/2');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('siravel/files');
    }
}
