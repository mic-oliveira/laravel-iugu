<?php


namespace Iugu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iugu\Traits\IuguBaseTrait;
use Iugu\Traits\IuguCustomerTrait;


class Customer extends Model
{
    use SoftDeletes;
    use IuguBaseTrait;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'cpf_cnpj',
        'notes',
        'phone_prefix',
        'phone',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'zip_code',
        'custom_variables',
    ];

    protected $casts = [
        'custom_variables' => 'json'
    ];

    public function invoice()
    {
        $relation=$this->hasMany(Invoice::class);
        $relation->setQuery(Invoice::where('customer_id', '=', $this->iugu_id)->getQuery());
        return $relation;
    }

    public function payment_method()
    {
        $relation=$this->hasMany(PaymentMethod::class);
        $relation->setQuery(PaymentMethod::where('customer_id','=',$this->iugu_id)->getQuery());
        return $relation;
    }

}
