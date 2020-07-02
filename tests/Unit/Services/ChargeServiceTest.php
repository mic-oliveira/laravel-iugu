<?php


namespace Iugu\Tests\Unit\Services;


use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Iugu\Models\Charge;
use Iugu\Services\ChargeService;
use Iugu\Tests\IuguTestTrait;

class ChargeServiceTest extends \Iugu\Tests\TestCase
{
    use IuguTestTrait;

    private ChargeService $chargeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../../../database/factories');
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__.'/../../../database/migrations'),
        ]);
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../../database/migrations'));
        $this->chargeService=app()->make(ChargeService::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public function testCharge()
    {
        $data=[
            'token'=>'647e1d58-cf57-4fb2-96ce-e502c1bb1904',
            'customer_id'=>'5613F5336CDB44FE9737C84E885D3020',
            'email'=>'michaelferreira@intnet.com.br',
            'items'=>[
                [
                    'description'=>'TESTE SERVICE'
                    ,'quantity'=>1,
                    'price_cents'=>100
                ]
            ]
        ];
        $this->chargeService->chargeRepository
            ->setClient(new Client(['handler' => $this->mockPlanRequest()]));
        $this->assertInstanceOf(Charge::class,$this->chargeService->charge($data));
    }

}
