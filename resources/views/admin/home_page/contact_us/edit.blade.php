@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Contact Us</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Contact Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/home_page/contact_us', array('update'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="form-group">
                                <label>*Address :</label>
                                <textarea  name="address" id="address" title="enter address!" class="district-input-field form-control" rows="8" placeholder="Enter address"
                                          required >{{old('address',$address)}}</textarea>                               
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>*Google Map Link :</label>
                                <input type="text" name="google_map_link" id="google_map_link" title="enter  google map link!" class="district-input-field form-control" placeholder="Google map link"
                                       value="{{$google_map_link}}" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>*Email Address :</label>
                                <input type="email" name="email_address" id="email_address" title="enter email address!" class="district-input-field form-control" placeholder="email address"
                                       value="{{$email_address}}" required >
                                <div id="msg_2">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>*Phone Number :</label>
                                <input type="text" name="phone_number" id="phone_number" title="enter phone number!" class="district-input-field form-control" placeholder="phone number"
                                       value="{{$phone_number}}" required >
                                <div id="msg_3">&nbsp;</div>
                            </div>


                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection


