<?php


namespace Iugu\Services;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Iugu\Repositories\ChargeRepository;
use Mockery\Exception;

class ChargeService
{
    public ChargeRepository $chargeRepository;

    /**
     * ChargeService constructor.
     * @param ChargeRepository $chargeService
     */
    public function __construct(ChargeRepository $chargeRepository)
    {
        $this->chargeRepository = $chargeRepository;
    }

    /**
     * @param $chargeData
     * @return Model|mixed
     * @throws BindingResolutionException
     */
    public function charge($chargeData)
    {
        try{
            $charge = $this->chargeRepository->createModel();
            $charge->customer_id = $chargeData['customer_id'];
            $charge->fill($chargeData);
            $charge->charge();
            return $charge;
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
