<?php


namespace Iugu\Models;

use Illuminate\Database\Eloquent\Model;
use Iugu\Traits\IuguBaseTrait;
use Iugu\Traits\IuguCustomerTrait;


class Customer extends Model
{
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
        'custom_variables' => 'object'
    ];

}
