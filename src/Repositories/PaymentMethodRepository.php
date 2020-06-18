<?php


namespace Iugu\Repositories;


use Iugu\Models\PaymentMethod;
use Iugu\Traits\IuguBaseTrait;

class PaymentMethodRepository extends BaseRepository
{
    use IuguBaseTrait;

    public function model()
    {
        return PaymentMethod::class;
    }
}
