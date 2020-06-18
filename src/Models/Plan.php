<?php


namespace Iugu\Models;


use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'name',
        'identifier',
        'interval',
        'interval_type',
        'value_cents',
        'payable_with',
        'features'
    ];
}
