<?php


namespace Iugu\Repositories;


use Iugu\Models\Subscription;

class SubscriptionRepository extends BaseRepository
{

    public function model()
    {
        return Subscription::class;
    }
}
