<?php


namespace Iugu\Tests\Unit\Models;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Plan;
use Iugu\Tests\IuguTestTrait;
use Iugu\Tests\TestCase;

class PlanTest extends TestCase
{
    use DatabaseMigrations;
    use IuguTestTrait;

    private Plan $plan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../../../database/factories');
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__.'/../../../database/migrations'),
        ]);
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../../database/migrations'));
        $this->plan = factory(Plan::class)->make();
    }

    public function testPost()
    {
        $this->assertIsObject($this->plan->setClient(new Client(['handler'=>$this->mockPlanRequest()]))
            ->postRequest());
    }

    public function updateRequest()
    {
        $this->assertIsObject($this->plan->setClient(new Client(['handler'=>$this->mockPlanRequest()]))
            ->updateRequest());
    }

    public function testDeleteRequest()
    {
        $this->assertIsObject($this->plan->setClient(new Client(['handler'=>$this->mockPlanRequest()]))
            ->deleteRequest());
    }

    public function testCreateRequest()
    {
        $this->assertInstanceOf(Client::class,$this->plan->createRequest());
    }

    public function testSaveRequest()
    {
        $this->expectException(ClientException::class);
        $this->plan->saveRequest();
        $plan = $this->plan->setClient(new Client(['handler' => $this->mockPlanRequest()]))->saveRequest();
        $this->assertIsObject($plan);
    }

    public function testSync()
    {
        $this->expectException(ClientException::class);
        $this->plan->sync();
        $this->assertTrue($this->plan->setClient(new Client(['handler' => $this->mockPlanRequest()]))->sync());
    }

    public function testSyncDelete()
    {
        $this->testSync();
        $this->plan = Plan::find(1);
        $this->expectException(ClientException::class);
        $this->plan->syncDelete();
        $this->assertIsBool($this->plan->setClient(new Client(['handler' => $this->mockPlanRequest()]))
            ->syncDelete());
        $this->assertNull($this->plan->setClient(new Client(['handler' => $this->mockPlanRequest()]))
            ->syncDelete());
    }


}
