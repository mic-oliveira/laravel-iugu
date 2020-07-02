<?php


namespace Iugu\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iugu\Traits\IuguBaseTrait;

class PaymentMethod extends BaseModel
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

    public function customer()
    {
        $relation=$this->belongsTo(Customer::class);
        $relation->setQuery(Customer::where('iugu_id','=','customer_id'));
        return $relation;
    }
}
