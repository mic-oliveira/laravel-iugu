<?php

namespace Iugu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iugu\Traits\IuguInvoiceTrait;

class Invoice extends Model
{
    use SoftDeletes;
    use IuguInvoiceTrait;

    protected $table = 'invoices';

    protected $fillable = [
        'iugu_id',
        'email',
        'due_date',
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
        'items',
        'logs',
    ];

    protected $casts=[
        'items' => 'json',
        'logs' =>  'json'
    ];

    public function getCustomerAttribute()
    {
        $customer=null;
        if(!empty($this->customer_id))
        {
            $customer=Customer::where('iugu_id','=',$this->customer_id)->get()->first();
        }
        return $customer;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionAttribute()
    {
        $subscription = null;
        if(!empty($this->subscription_id))
        {
            $subscription=Subscription::where('iugu_id','=',$this->subscription_id)->get()->first();
        }
        return $subscription;
    }


    public function refund()
    {
        if(empty($this->refund_at))
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
