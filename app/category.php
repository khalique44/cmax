<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function scopeActive($query){
        return $query->where('active','yes')->get();
    }
}
