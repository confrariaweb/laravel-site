<?php

namespace Confrariaweb\Site\Repositories\Contracts;

interface SiteContract
{
    public function all();

    public function create($data);

    public function where($data);

    public function delete($id);

    public function find($id);

    public function findDomain($domain);

    public function findBy($field, $value);

    public function findThis();

    public function paginate($perPage = 15);

    public function update($data, $id);
}