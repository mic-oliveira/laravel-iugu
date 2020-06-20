<?php


namespace Iugu\Tests\Unit\Services;


use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Invoice;
use Iugu\Services\InvoiceService;
use Iugu\Tests\IuguTestTrait;
use Iugu\Tests\TestCase;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class InvoiceServiceTest extends TestCase
{
    use DatabaseMigrations;
    use IuguTestTrait;

    private InvoiceService $invoiceService;

    /**
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../../../database/factories');
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__.'/../../../database/migrations'),
        ]);
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../../database/migrations'));
        $this->invoiceService = app()->make(InvoiceService::class);
    }

    public function testGet()
    {
        $this->assertInstanceOf(QueryBuilder::class, $this->invoiceService->get());
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testPost()
    {
        $this->invoiceService->invoiceRepository->setClient(new Client(['handler'=>$this->mockInvoiceRequest()]));
        $invoice = factory(Invoice::class)->make();
        $this->assertInstanceOf(Invoice::class,$this->invoiceService->create($invoice->toArray()));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testShow()
    {
        $this->testPost();
        $this->invoiceService->invoiceRepository->setClient(new Client(['handler'=>$this->mockInvoiceRequest()]));
        $this->assertInstanceOf(Invoice::class, $this->invoiceService->show(1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testUpdate()
    {
        $this->testPost();
        $invoice = ['status' => 'TESTE'];
        $this->invoiceService->invoiceRepository->setClient(new Client(['handler'=>$this->mockInvoiceRequest()]));
        $this->assertInstanceOf(Invoice::class, $this->invoiceService->update($invoice, 1));
    }

    /**
     * @throws BindingResolutionException
     */
    public function testSync()
    {
        $this->invoiceService->invoiceRepository->setClient(new Client(['handler'=>$this->mockInvoiceRequest()]));
        $invoice = factory(Invoice::class)->make();
        $this->assertInstanceOf(Invoice::class,$this->invoiceService->sync($invoice->toArray()));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testRefund()
    {
        $this->testPost();
        $this->invoiceService->invoiceRepository->setClient(new Client(['handler' => $this->mockInvoiceRequest()]));
        $this->assertInstanceOf(Invoice::class, $this->invoiceService->refund(1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testCancel()
    {
        $this->testPost();
        $this->invoiceService->invoiceRepository->setClient(new Client(['handler' => $this->mockInvoiceRequest()]));
        $this->assertInstanceOf(Invoice::class, $this->invoiceService->cancel(1));
    }

}
