<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'status'
    ];

}
