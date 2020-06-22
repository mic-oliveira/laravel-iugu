<?php


namespace Iugu\Services;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Iugu\Repositories\PlanRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class PlanService
{
    public PlanRepository $planRepository;

    /**
     * PlanService constructor.
     * @param PlanRepository $planRepository
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    /**
     * @return QueryBuilder
     */
    public function get()
    {
        return $this->planRepository->get();
    }

    /**
     * @param $planData
     * @return Model|mixed
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function create($planData)
    {
        $plan = $this->planRepository->createModel();
        $plan->fill($planData)->saveOrFail();
        return $plan;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function show($id)
    {
        return $this->planRepository->find($id);
    }

    /**
     * @param $planData
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function update($planData,$id)
    {
        $plan = $this->planRepository->find($id);
        $plan->fill($planData)->saveOrFail();
        return $plan;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function delete($id)
    {
        $plan = $this->planRepository->find($id);
        $plan->delete();
        return $plan;
    }

    /**
     * @param $planData
     * @return Model|mixed
     * @throws BindingResolutionException
     */
    public function sync($planData)
    {
        $plan = $this->planRepository->createModel();
        $plan->fill($planData)->sync();
        return $plan;
    }

}
