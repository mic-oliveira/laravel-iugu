<?php


namespace Iugu\Tests\Unit\Repositories;


use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Iugu\Models\Charge;
use Iugu\Repositories\ChargeRepository;
use Iugu\Tests\TestCase;

class ChargeRepositoryTest extends TestCase
{
    private ChargeRepository $chargeRepository;

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
        $this->chargeRepository = app()->make(ChargeRepository::class);
    }


    public function testModel()
    {
        $this->assertEquals(Charge::class, $this->chargeRepository->model());
    }

    /**
     * @throws BindingResolutionException
     */
    public function testCreateModel()
    {
        $this->assertInstanceOf(Charge::class, $this->chargeRepository->createModel());
    }

    /**
     * @throws BindingResolutionException
     */
    public function testFind()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->chargeRepository->find(1);
        factory(Charge::class)->create();
        $this->assertInstanceOf(Charge::class, $this->chargeRepository->find(1));
    }

    /**
     * @throws BindingResolutionException
     */
    public function testFindIuguId()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->chargeRepository->findIuguId(1);
        factory(Charge::class)->create();
        $this->assertInstanceOf(Charge::class, $this->chargeRepository->findIuguId(1));
    }

    public function setClientTest()
    {
        $this->assertInstanceOf(Client::class, new Client());
    }

}
