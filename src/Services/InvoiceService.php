<?php

namespace Iugu\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Iugu\Repositories\InvoiceRepository;
use Throwable;

class InvoiceService
{
    public InvoiceRepository $invoiceRepository;

    /**
     * InvoiceService constructor.
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }


    public function get()
    {
        return $this->invoiceRepository->get();
    }

    /**
     * @param $invoiceData
     * @return Model|mixed
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function create($invoiceData)
    {
        $invoice=$this->invoiceRepository->createModel();
        $invoice->fill($invoiceData)->saveOrFail();
        return $invoice;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function show($id)
    {
        return $this->invoiceRepository->find($id);
    }

    /**
     * @param $invoiceData
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function update($invoiceData, $id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->fill($invoiceData)->saveOrFail();
        return $invoice;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function delete($id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->delete();
        return $invoice->delete();
    }

    /**
     * @param $invoiceData
     * @return Model|mixed
     * @throws BindingResolutionException
     */
    public function sync($invoiceData)
    {
        $invoice= $this->invoiceRepository->createModel();
        $invoice->fill($invoiceData)->syncOrFail();
        return $invoice;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function refund($id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->refundInvoice();
        return $invoice;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function cancel($id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->cancel();
        return $invoice;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function sendEmail($id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->sendEmail();
        return $invoice;
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function capture($id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->capture();
        return $invoice;
    }
}
