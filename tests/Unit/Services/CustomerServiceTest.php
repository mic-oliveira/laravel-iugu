<?php


namespace Iugu\Tests\Unit\Services;


use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Customer;
use Iugu\Services\CustomerService;
use Iugu\Tests\IuguTestTrait;
use Iugu\Tests\TestCase;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class CustomerServiceTest extends TestCase
{
    use DatabaseMigrations;
    use IuguTestTrait;

    private CustomerService $customerService;

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
        $this->customerService = app()->make(CustomerService::class);
    }

    public function testGet()
    {
        $this->assertInstanceOf(QueryBuilder::class, $this->customerService->get());
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testPost()
    {
        $customer=factory(Customer::class)->make(['cpf_cnpj'=>'14576487760']);
        $this->customerService->customerRepository->setClient(new Client(['handler'=>$this->mockCustomerRequest()]));
        $this->assertInstanceOf(Customer::class,$this->customerService->post($customer->toArray()));
    }

    public function testShow()
    {
        $this->testPost();
        $this->customerService->customerRepository->setClient(new Client(['handler'=>$this->mockCustomerRequest()]));
        $this->assertInstanceOf(Customer::class, $this->customerService->show(1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testUpdate()
    {
        $this->testPost();
        $customer=["name"=>"Teste Update"];
        $this->customerService->customerRepository->setClient(new Client(['handler'=>$this->mockCustomerRequest()]));
        $this->assertInstanceOf(Customer::class, $this->customerService->update($customer,1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testDelete()
    {
        $this->testPost();
        $this->customerService->customerRepository->setClient(new Client(['handler'=>$this->mockCustomerRequest()]));
        $this->assertInstanceOf(Customer::class, $this->customerService->delete(1));
    }

    /**
     * @throws BindingResolutionException
     */
    public function testSync()
    {
        $customer = factory(Customer::class)->make(['cpf_cnpj'=> 14576487760]);
        $this->customerService->customerRepository->setClient(new Client(['handler'=>$this->mockCustomerRequest()]));
        $this->assertInstanceOf(Customer::class, $this->customerService->sync($customer->toArray()));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function syncDelete()
    {
        $this->testPost();
        $this->customerService->customerRepository->setClient(new Client(['handler'=>$this->mockCustomerRequest()]));
        $this->assertInstanceOf(Customer::class, $this->customerService->syncDelete(1));
    }
}
