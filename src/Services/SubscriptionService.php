<?php


namespace Iugu\Services;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Iugu\Repositories\SubscriptionRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class SubscriptionService
{
    private SubscriptionRepository $subscriptionRepository;

    /**
     * SubscriptionService constructor.
     * @param SubscriptionRepository $subscriptionRepository
     */
    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @return QueryBuilder
     */
    public function get()
    {
        return $this->subscriptionRepository->get();
    }

    /**
     * @param $subscriptionData
     * @return Model|mixed
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function create($subscriptionData)
    {
        $subscription = $this->subscriptionRepository->createModel();
        $subscription->fill($subscriptionData)->saveOrFail();
        return $subscription;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function show($id)
    {
        return $this->subscriptionRepository->find($id);
    }

    /**
     * @param $subscriptionData
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function update($subscriptionData,$id)
    {
        $subscription = $this->subscriptionRepository->find($id);
        $subscription->fill($subscriptionData)->saveOrFail();
        return $subscription;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function delete($id)
    {
        $subscription = $this->subscriptionRepository->find($id);
        $subscription->delete();
        return $subscription;
    }

}
