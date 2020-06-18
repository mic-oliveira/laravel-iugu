<?php


namespace Iugu\Traits;


use Exception;
use GuzzleHttp\Exception\ClientException;

trait IuguInvoiceTrait
{
    use IuguBaseTrait;

    public function refundInvoice()
    {
        return $this->decodeResponse($this->createRequest()->post($this->getBasePath()."/refund"));
    }

    public function cancelInvoice()
    {
        return $this->decodeResponse($this->createRequest()->put($this->getBasePath()."/cancel"));
    }

    public function duplicateInvoice()
    {
        return $this->decodeResponse($this->createRequest()->post($this->getBasePath()."/duplicate"));
    }

    public function sendEmailInvoice()
    {
        return $this->decodeResponse($this->createRequest()->post($this->getBasePath()."/send_email"));
    }

    public function getIuguDataAttribute()
    {
        return $this->decodeResponse($this->createRequest()->get($this->getBasePath()));
    }

    public function captureInvoice()
    {
        return $this->decodeResponse($this->createRequest()->post($this->getBasePath()."/capture"));
    }
}
