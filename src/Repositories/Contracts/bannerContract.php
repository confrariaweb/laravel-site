<?php

namespace Confrariaweb\Site\Repositories\Contracts;

interface BannerContract
{
    public function all();

    public function create($data);

    public function destroy($id);

    public function find($id);

    public function findBy($field, $value);

    public function update($data, $id);

    public function updateOrCreate($data);

    public function where($data);
}