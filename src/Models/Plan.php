<?php


namespace Iugu\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iugu\Traits\IuguBaseTrait;

class Plan extends Model
{
    use SoftDeletes;
    use IuguBaseTrait;

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
