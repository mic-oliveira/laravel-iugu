<?php


namespace Iugu\Repositories;


use Iugu\Models\Subscription;
use Iugu\Traits\IuguBaseTrait;

class SubscriptionRepository extends BaseRepository
{

    public function model()
    {
        return Subscription::class;
    }
}
