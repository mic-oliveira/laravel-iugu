<?php


namespace Iugu\Tests\Unit\Repositories;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Iugu\Models\Plan;
use Iugu\Repositories\PlanRepository;
use Iugu\Tests\TestCase;
use Spatie\QueryBuilder\QueryBuilder;

class PlanRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private PlanRepository $planRepository;

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
        $this->planRepository = app()->make(PlanRepository::class);
    }

    public function testGet()
    {
        $this->assertInstanceOf(QueryBuilder::class,$this->planRepository->get());
    }

    /**
     * @throws BindingResolutionException
     */
    public function testFind()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->planRepository->find(1);
        factory($this->planRepository)->create();
        $this->planRepository->find(1);
    }

    /**
     * @throws BindingResolutionException
     */
    public function testCreateModel()
    {
        $this->assertInstanceOf(Plan::class, $this->planRepository->createModel());
    }
}
