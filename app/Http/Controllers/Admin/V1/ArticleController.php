<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\ArticleService;
use App\Traits\ArticleValidatorTrait;


class ArticleController extends Controller
{
    use ArticleValidatorTrait;

    /**
     * @var ArticleService
     */
    private $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $requestParam = request()->input();
        if (request()->has('title')) {
            $requestParam['where'] = [
                ['title', 'like', '%' . $requestParam['title'] . '%']
            ];
        }
        if (request()->has('created_at_start')) {
            $requestParam['where'] = [
                ['created_at', '>=', $requestParam['created_at_start']]
            ];
        }
        if (request()->has('created_at_end')) {
            $requestParam['where'] = [
                ['created_at', '<=', $requestParam['created_at_end']]
            ];
        }

        return success($this->service->index($requestParam));
    }

    public function store()
    {
        $validator = $this->_Store();
        return success($this->service->store($validator->validated()));
    }

    public function show($id)
    {
        return success($this->service->show($id));
    }

    public function update($id)
    {
        $validator = $this->_Update();
        return success($this->service->update($id, $validator->validated()));
    }

    public function destroy($id)
    {
        return success($this->service->destroy($id));
    }

}
