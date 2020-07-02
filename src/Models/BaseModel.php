<?php


namespace Iugu\Models;


use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{

    public function getConnectionName()
    {
        return config('iugu.connection');
    }
}
