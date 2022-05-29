<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all();

    public function paginate($limit, $page);

    public function find($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function with($relations);
}
