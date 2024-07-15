<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyRecord extends Model
{
    protected $fillable = ['date', 'male_count', 'female_count', 'male_avg_age', 'female_avg_age'];
    protected $primaryKey = 'date';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->male_avg_age = User::where('gender', 'male')->avg('age');
            $model->female_avg_age = User::where('gender', 'female')->avg('age');
        });
    }
}
