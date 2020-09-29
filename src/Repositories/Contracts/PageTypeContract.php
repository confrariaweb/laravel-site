<?php

namespace Confrariaweb\Site\Repositories\Contracts;

interface PageTypeContract
{
    public function all();

    public function create(array $data);

    public function destroy($id);

    public function find($id);

    public function findBy($field, $value);

    public function paginate($perPage = 15);

    public function pluck($text, $id);

    public function update(array $data, $id);

    public function where(array $data);
}