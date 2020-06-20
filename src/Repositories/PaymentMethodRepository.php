<?php


namespace Iugu\Repositories;


use Iugu\Models\PaymentMethod;

class PaymentMethodRepository extends BaseRepository
{

    public function model()
    {
        return PaymentMethod::class;
    }
}
