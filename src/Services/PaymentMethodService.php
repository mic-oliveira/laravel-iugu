<?php


namespace Iugu\Services;


use Iugu\Repositories\PaymentMethodRepository;

class PaymentMethodService
{

    private PaymentMethodRepository $paymentMethodRepository;

    /**
     * PaymentMethodService constructor.
     * @param PaymentMethodRepository $paymentMethodRepository
     */
    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function get()
    {

    }

    public function create()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}
