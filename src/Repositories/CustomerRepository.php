<?php

namespace Iugu\Repositories;

use Iugu\Models\Customer;

class CustomerRepository extends BaseRepository
{

    public function model()
    {
        return Customer::class;
    }
}
