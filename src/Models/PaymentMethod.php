<?php


namespace Iugu\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iugu\Traits\IuguBaseTrait;

class PaymentMethod extends Model
{
    use SoftDeletes;
    use IuguBaseTrait;

    protected $table = 'payment_methods';

    protected $fillable = [
        'iugu_id',
        'customer_id',
        'description',
        'token',
        'set_as_default'
    ];
}
