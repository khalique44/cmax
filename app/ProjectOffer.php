<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [        
    	'project_id','offer','title','area',
    	'area_type','bedrooms','bathrooms','price_from','price_to','price_from_in_format',
    	'price_to_in_format'
    ];

    public function project()
	{
	    return $this->belongsTo(Project::class);
	}
}
