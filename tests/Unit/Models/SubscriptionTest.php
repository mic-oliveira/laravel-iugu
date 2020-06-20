<?php


namespace Iugu\Tests\Unit\Models;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Subscription;
use Iugu\Tests\IuguTestTrait;
use Iugu\Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use DatabaseMigrations;
    use IuguTestTrait;

    private Subscription $subscription;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../../../database/factories');
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__.'/../../../database/migrations'),
        ]);
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../../database/migrations'));
        $this->subscription = factory(Subscription::class)->make();
    }

    public function testPost()
    {
        $this->assertIsObject($this->subscription->setClient(new Client(['handler'=>$this->mockPlanRequest()]))
            ->postRequest());
    }

    public function updateRequest()
    {
        $this->assertIsObject($this->subscription->setClient(new Client(['handler'=>$this->mockPlanRequest()]))
            ->updateRequest());
    }

    public function testDeleteRequest()
    {
        $this->assertIsObject($this->subscription->setClient(new Client(['handler'=>$this->mockPlanRequest()]))
            ->deleteRequest());
    }

    public function testCreateRequest()
    {
        $this->assertInstanceOf(Client::class,$this->subscription->createRequest());
    }

    public function testSaveRequest()
    {
        $this->expectException(ClientException::class);
        $this->subscription->saveRequest();
        $plan = $this->subscription->setClient(new Client(['handler' => $this->mockPlanRequest()]))->saveRequest();
        $this->assertIsObject($plan);
    }

    public function testSync()
    {
        $this->expectException(ClientException::class);
        $this->subscription->sync();
        $this->assertTrue($this->subscription->setClient(new Client(['handler' => $this->mockPlanRequest()]))->sync());
    }

    public function testSyncDelete()
    {
        $this->testSync();
        $this->subscription = Subscription::find(1);
        $this->expectException(ClientException::class);
        $this->subscription->syncDelete();
        $this->assertIsBool($this->subscription->setClient(new Client(['handler' => $this->mockPlanRequest()]))
            ->syncDelete());
        $this->assertNull($this->subscription->setClient(new Client(['handler' => $this->mockPlanRequest()]))
            ->syncDelete());
    }


}
