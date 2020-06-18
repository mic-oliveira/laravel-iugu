<?php


namespace Iugu\Repositories;


use Iugu\Models\Plan;
use Iugu\Traits\IuguBaseTrait;

class PlanRepository extends BaseRepository
{
    use IuguBaseTrait;

    public function model()
    {
        return Plan::class;
    }
}
