<?php


namespace Iugu\Tests\Unit\Repositories;


use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Iugu\Models\Customer;
use Iugu\Repositories\CustomerRepository;
use Iugu\Tests\IuguTestTrait;

class CustomerRepositoryTest extends \Iugu\Tests\TestCase
{
    use IuguTestTrait;

    private CustomerRepository $customerRepository;

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
        $this->customerRepository = app()->make(CustomerRepository::class);
    }

    public function testModel()
    {
        $this->assertEquals(Customer::class, $this->customerRepository->model());
    }

    /**
     * @throws BindingResolutionException
     */
    public function testCreateModel()
    {
        $this->assertInstanceOf(Customer::class, $this->customerRepository->createModel());
    }

    /**
     * @throws BindingResolutionException
     */
    public function testFind()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->customerRepository->find(1);
        factory(Customer::class)->create();
        $this->assertInstanceOf(Customer::class, $this->customerRepository->find(1));
    }

    /**
     * @throws BindingResolutionException
     */
    public function testFindIuguId()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->customerRepository->findIuguId(1);
        factory(Customer::class)->create();
        $this->assertInstanceOf(Customer::class, $this->customerRepository->findIuguId(1));
    }

    public function setClientTest()
    {
        $this->assertInstanceOf(Client::class,new Client());
    }
}
