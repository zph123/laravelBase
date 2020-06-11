<?php

namespace App\Services\V1;

use App\Models\Article;

class ArticleService
{

    /**
     * @var Article
     */
    private $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function index($param)
    {
        $per_page = 20;
        $query = $this->model->newQuery();
        if (isset($param['where']) && !empty($param['where'])) {
            $query->where($param['where']);
        }
        if (isset($param['per_page']) && !empty($param['per_page'])) {
            $per_page = $param['per_page'];
        }
        return $query->orderBy('id', 'desc')->paginate($per_page);
    }

    public function store($param)
    {
        $param['status'] = 1;
        return $this->model->newQuery()->create($param);
    }

    public function show($id)
    {
        return $this->model->newQuery()->find($id);
    }

    public function update($id, $param)
    {
        $data = $this->model->newQuery()->findOrFail($id);

        return $data->fill($param)->save();
    }

    public function destroy($id)
    {
        return $this->model->newQuery()->where('id', $id)->delete();
    }

}

