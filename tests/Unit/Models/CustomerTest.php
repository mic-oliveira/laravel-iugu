<?php


namespace Iugu\Tests\Unit\Models;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Customer;
use Iugu\Tests\IuguTestTrait;
use Orchestra\Testbench\TestCase;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;
    use IuguTestTrait;

    private Customer $customer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../../../database/factories');
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__.'/../../../database/migrations'),
        ]);
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../../database/migrations'));
        $this->customer = factory(Customer::class)->make();
    }

    public function testPostClient()
    {
        $this->assertIsObject($this->customer
            ->setClient(new Client(['handler' => $this->mockCustomerRequest()]))->postRequest());
    }

    public function testUpdateClient()
    {
        $this->assertIsObject($this->customer
            ->setClient(new Client(['handler' => $this->mockCustomerRequest()]))->updateRequest());
    }

    /**
     * @throws Exception
     */
    public function testDelete()
    {

        $this->assertIsObject($this->customer
            ->setClient(new Client(['handler' => $this->mockCustomerRequest()]))->deleteRequest());
    }

    public function testSaveIugu()
    {
        $this->expectException(ClientException::class);
        $this->customer->saveRequest();
        $customer = $this->customer->setClient(new Client(['handler' => $this->mockCustomerRequest()]))->saveRequest();
        $this->assertIsObject($customer);
    }

    public function testCreateRequest()
    {
        $this->assertInstanceOf(Client::class,$this->customer->createRequest());
    }

    public function testSyncDelete()
    {
        $this->testSync();
        $this->customer = Customer::find(1);
        $this->expectException(ClientException::class);
        $this->customer->syncDelete();
        $this->assertIsBool($this->customer->setClient(new Client(['handler' => $this->mockCustomerRequest()]))
            ->syncDelete());
        $this->assertNull($this->customer->setClient(new Client(['handler' => $this->mockCustomerRequest()]))
            ->syncDelete());
    }

    public function testSync()
    {
        $this->expectException(ClientException::class);
        $this->customer->sync();
        $this->assertTrue($this->customer->setClient(new Client(['handler' => $this->mockCustomerRequest()]))->sync());
    }
}
