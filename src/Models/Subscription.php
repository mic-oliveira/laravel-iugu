<?php


namespace Iugu\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iugu\Traits\IuguBaseTrait;

class Subscription extends Model
{
    use SoftDeletes;
    use IuguBaseTrait;

    protected $table='subscriptions';

    protected $fillable=[
        'iugu_id',
        'plan_identifier',
        'only_on_charge_success',
        'ignore_due_email',
        'price_cents',
        'payable_with',
        'credits_based',
        'credits_cycle',
        'credits_min',
        'two_steps',
        'suspend_on_invoice_expired',
        'customer_id',
        'expire_at'
    ];
}
