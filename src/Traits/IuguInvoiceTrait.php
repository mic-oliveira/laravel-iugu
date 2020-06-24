<?php


namespace Iugu\Traits;


use Exception;
use GuzzleHttp\Exception\ClientException;

trait IuguInvoiceTrait
{
    use IuguBaseTrait;

    public function refundInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/refund"));
        $invoice=collect($invoice)->toArray();
        $this->fill($invoice)->saveOrFail();
        return $this;
    }

    public function cancelInvoice()
    {
        return $this->decodeResponse($this->createRequest()->put($this->getBasePath()."/cancel"));
    }

    public function duplicateInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/duplicate",[
            'json' => collect($this->toArray())->except('items')->toArray()
        ]));
        $this->iugu_id=$invoice->id;
        $invoice=collect($invoice)->toArray();
        $this->fill($invoice)->saveOrFail();
        return $this;
    }

    public function sendEmailInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/send_email"));
        $invoice=collect($invoice)->toArray();
        $this->fill($invoice)->saveOrFail();
        return $this;
    }

    public function captureInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/capture"));
        $invoice=collect($invoice)->toArray();
        $this->fill($invoice)->saveOrFail();
        return $this;
    }
}
