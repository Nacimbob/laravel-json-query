<?php

namespace QueryJson\Test\Stubs;

use Illuminate\Database\Eloquent\Model;

class JsonModel extends Model
{
    protected $table = 'test_json';

    protected $fillable = ['json'];

    protected $casts = ['json' => 'array'];
}