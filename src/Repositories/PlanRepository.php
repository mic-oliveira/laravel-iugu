<?php


namespace Iugu\Repositories;


use Iugu\Models\Plan;

class PlanRepository extends BaseRepository
{

    public function model()
    {
        return Plan::class;
    }
}
