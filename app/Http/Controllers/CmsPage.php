<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;

class CmsPage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function showAboutUs(){
        $aboutus_title = GeneralHelper::getOption('aboutus_title');
        $aboutus_header_image = GeneralHelper::getOption('aboutus_header_image');

        $aboutus_section1_title1 = GeneralHelper::getOption('aboutus_section1_title1');
        $aboutus_section1_title2 = GeneralHelper::getOption('aboutus_section1_title2');
        $aboutus_section1_description1 = GeneralHelper::getOption('aboutus_section1_description1');

        $aboutus_section2_title1 = GeneralHelper::getOption('aboutus_section2_title1');
        $aboutus_section2_title2 = GeneralHelper::getOption('aboutus_section2_title2');
        $aboutus_section2_description1 = GeneralHelper::getOption('aboutus_section2_description1');

        $aboutus_section3_title1 = GeneralHelper::getOption('aboutus_section3_title1');
        $aboutus_section3_title2 = GeneralHelper::getOption('aboutus_section3_title2');
        $aboutus_section3_description1 = GeneralHelper::getOption('aboutus_section3_description1');
        $aboutus_section3_description2 = GeneralHelper::getOption('aboutus_section3_description2');
        $aboutus_section3_image1 = GeneralHelper::getOption('aboutus_section3_image1');
        $aboutus_section3_image2 = GeneralHelper::getOption('aboutus_section3_image2');

        $aboutus_meta_title = GeneralHelper::getOption('aboutus_meta_title');
        $aboutus_meta_description = GeneralHelper::getOption('aboutus_meta_description');
        $aboutus_meta_keywords = GeneralHelper::getOption('aboutus_meta_keywords');

        return view('cms_pages.about_us',compact(
            'aboutus_title',
            'aboutus_header_image',

            'aboutus_section1_title1',
            'aboutus_section1_title2',
            'aboutus_section1_description1',

            'aboutus_section2_title1',
            'aboutus_section2_title2',
            'aboutus_section2_description1',

            'aboutus_section3_title1',
            'aboutus_section3_title2',
            'aboutus_section3_description1',
            'aboutus_section3_description2',
            'aboutus_section3_image1',
            'aboutus_section3_image2',

            'aboutus_meta_title',
            'aboutus_meta_description',
            'aboutus_meta_keywords',
        

            ));
    }

    public function showCareer(){
        $career_title = GeneralHelper::getOption('career_title');
        $career_header_image = GeneralHelper::getOption('career_header_image');
        $career_description = GeneralHelper::getOption('career_description');        

        $career_meta_title = GeneralHelper::getOption('career_meta_title');
        $career_meta_description = GeneralHelper::getOption('career_meta_description');
        $career_meta_keywords = GeneralHelper::getOption('career_meta_keywords');

        return view('cms_pages.career',compact(
            'career_title',
            'career_header_image',
            'career_description',            

            'career_meta_title',
            'career_meta_description',
            'career_meta_keywords',
        

            ));
    }
}
