<?php

namespace Iugu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iugu\Traits\IuguInvoiceTrait;

class Invoice extends BaseModel
{
    use SoftDeletes;
    use IuguInvoiceTrait;

    protected $table = 'invoices';

    protected $fillable = [
        'iugu_id',
        'email',
        'status',
        'due_date',
        'total_cents',
        'ensure_workday_due_date',
        'amount',
        'discount_cents',
        'return_url',
        'expire_url',
        'notification_url',
        'ignore_canceled_email',
        'fines',
        'late_payment_fines',
        'ignore_due_email',
        'custom_variables',
        'early_payment_discount',
        'early_payment_discounts',
        'customer_id',
        'subscription_id',
        'order_id',
        'items',
        'logs',
    ];

    protected $casts=[
        'items' => 'json',
        'logs' =>  'json',
        'custom_variables' => 'json',
        'early_payment_discounts' => 'json'
    ];

    public function customer()
    {
        $relation=$this->belongsTo(Customer::class);
        $relation->setQuery(Customer::where('iugu_id','=',$this->customer_id)->getQuery());
        return $relation;
    }

    /**
     * @return mixed
     */
    public function subscription()
    {
        $relation=$this->belongsTo(Subscription::class);
        $relation->setQuery(Customer::where('iugu_id','=',$this->subscription_id)->getQuery());
        return $relation;
    }


    public function refund()
    {
        if(empty($this->refund_at) && $this->status=='paid')
        {
            $this->refund_at=$this->refundInvoice();
        }
    }

    public function cancel()
    {
        if ($this->canceled_at && $this->status!='canceled') {
            $this->canceled_at = $this->cancelInvoice()->canceled_at;
        }
    }

    public function capture()
    {
        if ($this->capture_at) {
            $this->captured_at = $this->captureInvoice()->captured_at;
        }
    }
}
