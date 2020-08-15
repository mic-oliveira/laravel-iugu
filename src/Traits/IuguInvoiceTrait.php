<?php


namespace Iugu\Traits;


trait IuguInvoiceTrait
{
    use IuguBaseTrait;

    public function refundInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/refund"));
        $data=collect($invoice)->toArray();
        $this->fill($data);
        $this->setDates($invoice);
        $this->saveOrFail();
        return $this;
    }

    public function setDates($invoice)
    {
        $this->authorized_at_iso=$invoice->authorized_at_iso;
        $this->refunded_at_iso=$invoice->refunded_at_iso;
        $this->canceled_at_iso=$invoice->canceled_at_iso;
        $this->protested_at_iso=$invoice->protested_at_iso;
        $this->chargeback_at_iso=$invoice->chargeback_at_iso;
        $this->expired_at_iso=$invoice->expired_at_iso;
    }

    public function cancelInvoice()
    {
        $invoice = $this->decodeResponse($this->createRequest()->put($this->getBasePath()."/cancel"));
        $data=collect($invoice)->toArray();
        $this->fill($data);
        $this->setDates($invoice);
        $this->saveOrFail();
        $this->delete();
        return $this;
    }

    /**
     * @return $this
     */
    public function duplicateInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/duplicate",[
            'json' => collect($this->toArray())->toArray()
        ]));
        $this->iugu_id=$invoice->id;
        $data=collect($invoice)->toArray();
        $this->fill($data);
        $this->setDates($invoice);
        $this->saveOrFail();
        return $this;
    }

    /**
     * @param $description
     * @param $quantity
     * @param $price_cents
     * @return $this
     */
    public function addInvoiceItem($description,$quantity,$price_cents)
    {
        $this->items=collect($this->items)->add([
            'description'=>$description,
            'quantity'=>$quantity,
            'price_cents'=> $price_cents
        ])->toArray();
        return $this;
    }

    public function overrideItem()
    {
        $this->items=collect($this->items)->map(function($item) {
            return array_key_exists('id',$item)?collect($item)->merge(['_destroy'=>true]):$item;
        });
        return $this;
    }

    /**
     * @param $item_index
     * @return $this
     */
    public function removeInvoiceItem($item_index)
    {
        $items=collect($this->items);
        $excluded_items=$items->map(function($item,$index) use ($item_index) {
            return $index==$item_index?collect($item)->merge(['_destroy'=>true])->toArray():$item;
        });
        $this->items=$excluded_items;
        return $this;
    }

    public function sendEmailInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/send_email"));
        $data=collect($invoice)->toArray();
        $this->fill($data);
        $this->setDates($invoice);
        $this->saveOrFail();
        return $this;
    }

    public function captureInvoice()
    {
        $invoice=$this->decodeResponse($this->createRequest()->post($this->getBasePath()."/capture"),true);
        $data=collect($invoice)->toArray();
        $this->fill($data);
        $this->setDates($invoice);
        $this->saveOrFail();
        return $this;
    }
}
