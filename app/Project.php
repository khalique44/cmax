<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Http\Helpers\GeneralHelper;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [        
    	'builder_id','city_id','project_title','description','progress','area','location','latitude','longitude','logo_url','offering','is_lease','is_active','added_by'
    ];

    protected static function boot()
	{
	    parent::boot();

	    static::saving(function ($project) {
	        $slug = Str::slug($project->project_title);

	        // Check if slug already exists excluding the current project (if it's being updated)
	        $query = Project::where('slug', "{$slug}");

	        // Exclude self on update
	        if ($project->exists) {
	            $query->where('id', '!=', $project->id);
	        }

	        $count = $query->count();

	        $project->slug = $count ? "{$slug}-{$count}" : $slug;
	    });
	}


    public function properties()
	{
	    return $this->hasMany(Property::class,'project_id', 'id');
	}

    public static function getAllProjects(){

		return Project::with('offers','floorPlan', 'media')->latest()->get();
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

    public function builder()
	{
	    return $this->belongsTo(Builder::class);
	}

    public function registerMediaConversions(Media $media = null): void
	{
	    $this->addMediaConversion('thumb')
	        ->width(200)	        
	        ->sharpen(10);
	}

	public function getPriceRangeAttribute()
	{
	    return GeneralHelper::formatPriceRange($this->offers);
	}

	public function getMinMaxAttribute()
	{
	    $price_range = GeneralHelper::formatPriceRange($this->offers);
	    return $price_range['min']['amount'] .' '. $price_range['min']['unit'] .' to '. $price_range['max']['amount'] .' '. $price_range['max']['unit'];
	}
}
