<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    public function projects()
	{
	   return $this->belongsToMany(Project::class, 'project_features', 'feature_id', 'project_id');
	}
}
