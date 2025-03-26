@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Blogg</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/blog/posts')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Blogg Section ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        
                        <form class="" method="POST" action="{{url('admin/blog/posts')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            
                                
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>*Title :</label>
                                    <input type="text" name="title" id="title" title="enter title!" class="district-input-field form-control" placeholder="Title" required value="{{old('title')}}">
                                    <div id="msg_1">&nbsp;</div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Short Description :</label>
                                    <textarea  name="short_description" id="short_description" title="enter short description!" class="district-input-field form-control" rows="8" placeholder="Short Description"
                                             >{{old('short_description')}}</textarea>
                                    <div id="msg_2">&nbsp;</div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12">
                                <div class="clearfix">
                                    <label>Description :</label>
                                    <textarea  name="description" id="txtEditor" title="enter description!" class=" form-control" rows="8" cols="20" placeholder="Description"
                                             >{{old('description')}}</textarea>
                                    <div id="msg_2">&nbsp;</div>


                                </div>
                            </div>
                            
                            <div class="col-xs-12">   
                                <div class="form-group">
                                    <label>Upload Image (600 &times; 450):</label>
                                    <input type="file" name="file_url" id="file_url"  class="district-input-field form-control"  >
                                    
                                </div>
                            </div>  

                            <div class="col-xs-12">   
                                <div class="form-group">
                                    <label>Upload Header Image Detail Page (1920 &times; 915):</label>
                                    <input type="file" name="header_image" id="header_image"  class="district-input-field form-control"  >
                                    
                                </div>
                            </div>                          

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Active :</label>
                                    <div class="district-active-radio-field">
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="yes"class="" id="radio_active_yes" required checked>Yes</input>
                                        </label>
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="no" id="radio_active_no" required >No</input>
                                        </label>
                                    </div>
                                </div>
                            </div>   

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Save
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
