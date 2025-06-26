<?php

namespace App\Http\Controllers;
use App\Http\Helpers\RosenHelper;
use App\HomeSetting;
use App\AboutSection;
use App\Testimonial;
use App\TeamMember;
use App\Project;
use App\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = HomeSetting::find(1);
       
        $testimonials = Testimonial::where('status','yes')->get(); 
        $header_image = url('public/assets/images').'/header-bg.jpg';
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $offering = config('constants.offering');

        if(!empty($data->header_image)){
            
          if(file_exists( public_path().'/'.$data->header_image )){
            $header_image = url('public') .'/'.$data->header_image;
          } 
        }
        return view('home',compact('data','header_image','testimonials','builders','progress','property_types','bedrooms','offering'));
        
        //return '<H2>Coming Soon</H2';
    }

    public function searchArea(Request $request){

        $query = $request->get('query');

        $results = Project::where('location', 'like', '%' . $query . '%')
                ->pluck('location') // Only fetch 'location' column
                ->unique()          // Remove duplicates (if any)
                ->take(50);         // Limit results (optional)

        return response()->json($results);
    }

   
}
