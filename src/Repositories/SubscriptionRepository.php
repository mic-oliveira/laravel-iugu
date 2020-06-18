<?php


namespace Iugu\Repositories;


use Iugu\Models\Subscription;
use Iugu\Traits\IuguBaseTrait;

class SubscriptionRepository extends BaseRepository
{
    use IuguBaseTrait;

    public function model()
    {
        return Subscription::class;
    }
}
