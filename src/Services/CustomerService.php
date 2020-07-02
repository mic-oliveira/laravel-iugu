<?php

namespace Iugu\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Iugu\Models\Customer;
use Iugu\Repositories\CustomerRepository;
use Throwable;

class CustomerService
{

    public CustomerRepository $customerRepository;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function get()
    {
        return $this->customerRepository->get();
    }

    /**
     * @param $customerData
     * @return Model|mixed
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function create($customerData=[])
    {
        $customer = $this->customerRepository->createModel();
        $customer->fill($customerData)->save();
        return $customer;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function show($id)
    {
        return $this->customerRepository->find($id) ?? $this->customerRepository->findIuguId($id);
    }

    /**
     * @param $customerData
     * @param $id
     * @param bool $sync
     * @return mixed
     * @throws BindingResolutionException
     */
    public function update($customerData,$id,$sync=false)
    {
        $customer = $this->customerRepository->find($id);
        $sync?$customer->fill($customerData)->syncOrFail():$customer->saveOrFail();
        return $customer;
    }

    /**
     * @param $id
     * @throws BindingResolutionException
     */
    public function delete($id)
    {
        $customer = $this->customerRepository->find($id);
        $customer->delete();
        return $customer;
    }

    /**
     * @param $customerData
     * @return Model|mixed
     * @throws BindingResolutionException
     */
    public function sync($customerData)
    {
        $customer = $this->customerRepository->createModel();
        $customer->fill($customerData)->syncOrFail();
        return $customer;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function syncDelete($id)
    {
        $customer = $this->customerRepository->find($id);
        $customer->syncDelete();
        return $customer;
    }

    /**
     * @throws BindingResolutionException
     */
    public function syncAll()
    {
        $invoices=$this->customerRepository->createModel();
        $items=collect($invoices->list()->items);
        $items->each(function ($item){
            if(!Customer::where('iugu_id','=',$item->id)->exists()) {
                $customer=$this->customerRepository->createModel();
                $customer->iugu_id = $item->id;
                $customer->importFromIugu();
            }
        });
        return $items;
    }
}
