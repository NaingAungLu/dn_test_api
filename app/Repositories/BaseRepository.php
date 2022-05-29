<?php

namespace App\Repositories;

abstract class BaseRepository
{
    public function all()
    {
        return $this->model->get();
    }

    public function paginate($limit, $page)
    {
        return $this->model->simplePaginate($limit, ['*'], 'page', $page);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return false;
        }

        if (!$model->update($data)) {
            return false;
        }

        return $model;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return false;
        }

        return $model->delete();
    }

    public function with($relations)
    {
        $this->model = $this->model->with($relations);

        return $this;
    }
}
