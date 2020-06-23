<?php


namespace Iugu\Tests\Unit\Services;


use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Plan;
use Iugu\Services\PlanService;
use Iugu\Tests\IuguTestTrait;
use Iugu\Tests\TestCase;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class PlanServiceTest extends TestCase
{
    use DatabaseMigrations;
    use IuguTestTrait;

    private PlanService $planService;

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
        $this->planService = app()->make(PlanService::class);
    }

    public function testGet()
    {
        $this->assertInstanceOf(QueryBuilder::class, $this->planService->get());
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testPost()
    {
        $plan=factory(Plan::class)->make();
        $this->planService->planRepository->setClient(new Client(['handler'=>$this->mockPlanRequest()]));
        $this->assertInstanceOf(Plan::class,$this->planService->create($plan->toArray()));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testShow()
    {
        $this->testPost();
        $this->planService->planRepository->setClient(new Client(['handler'=>$this->mockPlanRequest()]));
        $this->assertInstanceOf(Plan::class, $this->planService->show(1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testUpdate()
    {
        $this->testPost();
        $plan=["name"=>"Teste Update"];
        $this->planService->planRepository->setClient(new Client(['handler'=>$this->mockPlanRequest()]));
        $this->assertInstanceOf(Plan::class, $this->planService->update($plan,1));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testDelete()
    {
        $this->testPost();
        $this->planService->planRepository->setClient(new Client(['handler'=>$this->mockPlanRequest()]));
        $this->assertInstanceOf(Plan::class, $this->planService->delete(1));
    }

    /**
     * @throws BindingResolutionException
     */
    public function testSync()
    {
        $customer = factory(Plan::class)->make();
        $this->planService->planRepository->setClient(new Client(['handler'=>$this->mockPlanRequest()]));
        $this->assertInstanceOf(Plan::class, $this->planService->sync($customer->toArray()));
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function syncDelete()
    {
        $this->testPost();
        $this->planService->planRepository->setClient(new Client(['handler'=>$this->mockPlanRequest()]));
        $this->assertInstanceOf(Plan::class, $this->planService->syncDelete(1));
    }
}
