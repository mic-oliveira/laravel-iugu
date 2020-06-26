<?php


namespace Iugu\Tests\Unit\Models;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Invoice;
use Iugu\Tests\IuguTestTrait;
use Iugu\Tests\TestCase;

class InvoiceTest extends TestCase
{

    use DatabaseMigrations;
    use IuguTestTrait;

    private Invoice $invoice;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../../../database/factories');
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__.'/../../../database/migrations'),
        ]);
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../../database/migrations'));
        $this->invoice = factory(Invoice::class)->make(['iugu_id'=>'5613F5336CDB44FE9737C84E885D3020']);
    }


    public function testSync()
    {
        $this->assertIsBool($this->invoice->setClient(new Client(['handler'=> $this->mockInvoiceRequest()]))
            ->sync());
    }

    public function testSyncDelete()
    {
        $this->testSync();
        $this->assertIsBool($this->invoice->setClient(new Client(['handler'=> $this->mockInvoiceRequest()]))
            ->syncDelete());
    }

    public function testPostInvoice()
    {
        $this->assertIsObject($this->invoice->setClient(new Client(['handler'=> $this->mockInvoiceRequest()]))
            ->postRequest());
    }

    public function testUpdateInvoice()
    {
        $this->assertIsObject($this->invoice->setClient(new Client(['handler'=> $this->mockInvoiceRequest()]))->updateRequest());
    }

    public function testRefundInvoice()
    {
        $this->assertIsObject($this->invoice->setClient(new Client(['handler' => $this->mockInvoiceRequest()]))
            ->refundInvoice());
    }

    public function testDuplicate()
    {
        $this->assertIsObject($this->invoice->setClient(new Client(['handler' => $this->mockInvoiceRequest()]))
            ->duplicateInvoice());
    }

    public function testCapture()
    {
        $this->assertIsObject($this->invoice->setClient(new Client(['handler' => $this->mockInvoiceRequest()]))
            ->captureInvoice());
    }
}
