<?php


namespace Iugu\Tests\Unit\Repositories;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Plan;
use Iugu\Models\Subscription;
use Iugu\Repositories\PlanRepository;
use Iugu\Repositories\SubscriptionRepository;
use Iugu\Tests\TestCase;
use Spatie\QueryBuilder\QueryBuilder;

class SubscriptionRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private SubscriptionRepository $subscriptionRepository;

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
        $this->subscriptionRepository = app()->make(SubscriptionRepository::class);
    }

    public function testGet()
    {
        $this->assertInstanceOf(QueryBuilder::class,$this->subscriptionRepository->get());
    }

    /**
     * @throws BindingResolutionException
     */
    public function testFind()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->subscriptionRepository->find(1);
        factory($this->subscriptionRepository)->create();
        $this->subscriptionRepository->find(1);
    }

    /**
     * @throws BindingResolutionException
     */
    public function testCreateModel()
    {
        $this->assertInstanceOf(Subscription::class, $this->subscriptionRepository->createModel());
    }
}
