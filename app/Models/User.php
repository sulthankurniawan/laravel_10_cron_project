<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['uuid', 'gender', 'name', 'location', 'age'];
    public $incrementing = false;
    protected $keyType = 'string';
}
