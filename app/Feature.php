<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
        'name','icon','file_url','is_active'

    ];

	protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];

    public function projects()
	{
	   return $this->belongsToMany(Project::class, 'project_features', 'feature_id', 'project_id');
	}
}
