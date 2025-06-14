<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [        
    	'builder_id','city_id','project_title','description','progress','area','location','latitude','longitude','logo_url','offering','is_lease','is_active','added_by'
    ];

    public function properties()
	{
	    return $this->hasMany(Property::class,'project_id', 'id');
	}

    public static function getAllProjects(){

		return Project::whereHas('properties')
			    ->with(['properties' => function ($query) {
			        $query->where('project_id', '!=', 0);
			    }])
			    ->latest()
			    ->get();
	}

	public function offers()
	{
	    return $this->hasMany(ProjectOffer::class);
	}

	public function floorPlan()
	{
	    return $this->hasMany(ProjectFloorPlan::class);
	}

	protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];

    public function registerMediaConversions(Media $media = null): void
	{
	    $this->addMediaConversion('thumb')
	        ->width(200)	        
	        ->sharpen(10);
	}
}
