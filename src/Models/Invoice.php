<?php

namespace Iugu\Models;

use Carbon\Carbon;
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
        'currency',
        'secure_id',
        'secure_url',
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
        'credit_card_band',
        'credit_card_bin',
        'credit_card_last_four',
        'credit_card_tid',
        'paid',
        'authorized_at',
        'authorized_at_iso',
        'refunded_at',
        'refunded_at_iso',
        'canceled_at',
        'canceled_at_iso',
        'protested_at',
        'protested_at_iso',
        'chargeback_at',
        'chargeback_at_iso',
        'expired_at',
        'expired_at_iso',
        'occurrence_date'
    ];

    protected $dates = [
        'authorized_at_iso',
        'refunded_at_iso',
        'canceled_at_iso',
        'protested_at_iso',
        'chargeback_at_iso',
        'expired_at_iso',
    ];

    protected $dateFormat='Y-m-d H:i:s';

    protected $casts = [
        'items' => 'json',
        'logs' =>  'json',
        'custom_variables' => 'json',
        'early_payment_discounts' => 'json'
    ];

    public function setAuthorizedAtIsoAttribute($value)
    {
        $this->attributes['authorized_at_iso']=Carbon::parse($value)??null;
    }

    public function setRefundedAtIsoAttribute($value)
    {
        $this->attributes['refunded_at_iso']=Carbon::parse($value)??null;
    }

    public function setCanceledAtIsoAttribute($value)
    {
        $this->attributes['canceled_at_iso']=Carbon::parse($value)??null;
    }

    public function setProtestedAtIsoAttribute($value)
    {
        $this->attributes['protested_at_iso']=Carbon::parse($value)??null;
    }

    public function setChargebackAtIsoAttribute($value)
    {
        $this->attributes['chargeback_at_iso']=Carbon::parse($value)??null;
    }

    public function setExpiredAtIsoAttribute($value)
    {
        $this->attributes['expired_at_iso']=Carbon::parse($value)??null;
    }

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
