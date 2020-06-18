<?php


namespace Iugu\Models;


use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = [
        'iugu_id',
        'customer_id',
        'description',
        'token',
        'set_as_default'
    ];
}
