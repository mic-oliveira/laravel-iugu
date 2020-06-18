<?php


namespace Iugu\Tests\Unit\Repositories;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Repositories\InvoiceRepository;
use Iugu\Tests\TestCase;
use Spatie\QueryBuilder\QueryBuilder;

class InvoiceRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private InvoiceRepository $invoiceRepository;

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
        $this->invoiceRepository = app()->make(InvoiceRepository::class);
    }

    public function testGet()
    {
        $this->assertInstanceOf(QueryBuilder::class,$this->invoiceRepository->get());
    }

    /**
     * @throws BindingResolutionException
     */
    public function testFind()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->invoiceRepository->find(1);
        factory($this->invoiceRepository)->create();
        $this->invoiceRepository->find(1);
    }

}
