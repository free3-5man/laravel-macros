<?php

namespace Freeman\LaravelMacros\Test\Models;

class User extends Model
{
    protected $table = 'users';

    public function getGenderZhCnAttribute()
    {
        return [
            'male' => '男',
            'female' => '女',
            'unknown' => '未知',
        ][$this->gender];
    }
}
