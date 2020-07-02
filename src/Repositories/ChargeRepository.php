<?php

namespace Iugu\Repositories;

use Iugu\Models\Charge;

class ChargeRepository extends BaseRepository
{

    public function model()
    {
        return Charge::class;
    }
}
