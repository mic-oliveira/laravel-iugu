<?php

namespace Iugu\Repositories;

use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseRepository
{
    protected $filters=[];
    protected $sorts=[];
    protected $includes=[];
    protected $fields=[];
    protected $attributes=[];

    private $client;

    abstract public function model();

    /**
     * @return mixed
     * @throws BindingResolutionException
     */
    public function createModel(): Model
    {
        $model = app()->make($this->model());
        if (!empty($this->client))
        {
            $model->setClient($this->client);
        }
        return $model;
    }

    /**
     *
     *
     */
    public function get()
    {
        return QueryBuilder::for($this->model())->allowedFields($this->fields)
            ->allowedSorts($this->sorts)->allowedFilters($this->filters)
            ->allowedIncludes($this->includes)->allowedAppends($this->attributes);
    }

    /**
     * @param $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function find($id)
    {
        return $this->createModel()::findOrFail($id);
    }

    /**
     * @param $iugu_id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function findIuguId($iugu_id)
    {
        $query = $this->createModel()::where('iugu_id','=',$iugu_id);
        if($query->exists()) {
            return $this->createModel()::where('iugu_id','=',$iugu_id)->get()->first();
        } else {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

}
