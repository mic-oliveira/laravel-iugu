<?php


namespace Iugu\Tests\Unit\Services;


use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Customer;
use Iugu\Models\Plan;
use Iugu\Models\Subscription;
use Iugu\Services\SubscriptionService;
use Iugu\Tests\IuguTestTrait;
use Iugu\Tests\TestCase;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class SubscriptionServiceTest extends TestCase
{
    use DatabaseMigrations;
    use IuguTestTrait;

    private SubscriptionService $subscriptionService;

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
        $this->subscriptionService = app()->make(SubscriptionService::class);
    }

    public function testGet()
    {
        $this->assertInstanceOf(QueryBuilder::class, $this->subscriptionService->get());
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testPost()
    {
        factory(Customer::class)->create();
        $subscription=factory(Subscription::class)->make(['client_id'=>1]);
        //dump($subscription->toArray());
        $this->subscriptionService->subscriptionRepository->setClient(new Client(['handler'=>$this->mockSubscriptionRequest()]));
        $this->assertInstanceOf(Subscription::class,$this->subscriptionService->create($subscription->toArray()));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testShow()
    {
        $this->testPost();
        $this->subscriptionService->subscriptionRepository->setClient(new Client(['handler'=>$this->mockSubscriptionRequest()]));
        $this->assertInstanceOf(Subscription::class, $this->subscriptionService->show(1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testUpdate()
    {
        $this->testPost();
        $subscription=["name"=>"Teste Update"];
        $this->subscriptionService->subscriptionRepository->setClient(new Client(['handler'=>$this->mockPlanRequest()]));
        $this->assertInstanceOf(Subscription::class, $this->subscriptionService->update($subscription,1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testDelete()
    {
        $this->testPost();
        $this->subscriptionService->subscriptionRepository->setClient(new Client(['handler'=>$this->mockSubscriptionRequest()]));
        $this->assertInstanceOf(Subscription::class, $this->subscriptionService->delete(1));
    }

    /**
     */
    public function testSync()
    {
        $subscription = factory(Subscription::class)->make(['client_id'=>1]);
        $this->subscriptionService->subscriptionRepository->setClient(new Client(['handler'=>$this->mockSubscriptionRequest()]));
        $this->assertInstanceOf(Subscription::class, $this->subscriptionService->sync($subscription->toArray()));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function syncDelete()
    {
        $this->testPost();
        $this->subscriptionService->subscriptionRepository->setClient(new Client(['handler'=>$this->mockSubscriptionRequest()]));
        $this->assertInstanceOf(Subscription::class, $this->subscriptionService->syncDelete(1));
    }
}
