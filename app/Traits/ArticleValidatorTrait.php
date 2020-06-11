<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait ArticleValidatorTrait
{
    protected function _Store()
    {
        $requestParam = request()->input();

        $rule = [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
        $message = [
            'title.required' => '标题必须存在',
            'content.required' => '内容必须存在',
        ];

        $validator = Validator::make(
            $requestParam,
            $rule,
            $message
        );

        if ($validator->fails()) {
            throw new HttpResponseException(
                error($validator->errors()->first(), 422)
            );
        }
        return $validator;
    }

    protected function _Update()
    {
        $requestParam = request()->input();

        $rule = [
            'title' => 'filled|max:255',
            'content' => 'filled',
            'status' => [
                'filled',
                Rule::in([0, 1]),
            ]
        ];
        $message = [
            'title.filled' => '标题不能为空',
            'content.filled' => '内容不能为空',
        ];

        $validator = Validator::make(
            $requestParam,
            $rule,
            $message
        );

        if ($validator->fails()) {
            throw new HttpResponseException(
                error($validator->errors()->first(), 422)
            );
        }
        return $validator;
    }
}
