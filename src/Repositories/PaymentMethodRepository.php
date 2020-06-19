<?php


namespace Iugu\Repositories;


use Iugu\Models\PaymentMethod;
use Iugu\Traits\IuguBaseTrait;

class PaymentMethodRepository extends BaseRepository
{

    public function model()
    {
        return PaymentMethod::class;
    }
}
