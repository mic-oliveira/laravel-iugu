<?php


namespace Iugu\Tests\Unit\Models;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Iugu\Models\Charge;
use Iugu\Tests\TestCase;

class ChargeTest extends TestCase
{
    private Charge $charge;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../../../database/factories');
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__.'/../../../database/migrations'),
        ]);
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../../database/migrations'));
        $this->charge = factory(Charge::class)->make();
    }

    /**
     * @throws GuzzleException
     */
    public function testCharge()
    {
        $this->expectException(ClientException::class);
        $this->charge->setBasePath('teste')->charge();
        $this->charge = factory(Charge::class)->make();
        $this->assertInstanceOf(Charge::class, $this->charge->charge());
    }
}
