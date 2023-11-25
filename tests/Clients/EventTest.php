<?php declare(strict_types=1);

namespace Clicksports\LexOffice\Tests\Clients;

use Clicksports\LexOffice\Clients\Event;
use GuzzleHttp\Psr7\Response;
use Clicksports\LexOffice\Tests\TestClient;

class EventTest extends TestClient
{

    public function testCreate()
    {
        $stub = $this->createClientMockObject(
            Event::class,
            new Response(200, [], 'body'),
            ['create']
        );

        $response = $stub->create([
            'version' => 0
        ]);

        $this->assertEquals('body', $response->getBody()->__toString());
    }

    public function testGetAll()
    {
        $stub = $this->createClientMockObject(
            Event::class,
            new Response(200, [], '{"content": [], "totalPages": 1}'),
            ['getAll']
        );

        $response = $stub->getAll();

        $this->assertEquals('{"content": [], "totalPages": 1}', $response->getBody()->__toString());
    }

    public function testDelete()
    {
        $stub = $this->createClientMockObject(
            Event::class,
            new Response(200, [], 'body'),
            ['delete']
        );

        $response = $stub->delete('resource-id');

        $this->assertEquals('body', $response->getBody()->__toString());
    }

}