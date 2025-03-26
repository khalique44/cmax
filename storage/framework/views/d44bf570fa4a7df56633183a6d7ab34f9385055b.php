<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Messages</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="<?php echo e(url('admin/messages')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Messages Section ===========  -->
            <!--  ===============================  -->

            <div class="row">
                 <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        
                        <form class="" method="POST" action="<?php echo e(url('admin/messages')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                           
                           <div class="col-xs-12 ">
                                <div class="form-group ">
                                    <label>Send Type :</label>
                                    <select name="send_type" id="send_type" class="form-control select2 ">
                                        <option value=""><?php echo e(__("Select Send Type")); ?></option>
                                        <?php $__currentLoopData = Config('constants.send_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $send_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php echo old('send_type') == $key ? 'selected' : ''; ?>><?php echo e($send_type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>   
                                </div>
                            </div> 

                            <div class="col-xs-12 <?php echo old('send_type') == 'Individual' ? '' : 'hidden'; ?> send-to">
                                <div class="form-group ">
                                    <label>All Users :</label>
                                    <select name="send_to" id="send_to"  class="form-control select2 ">
                                        <option value=""><?php echo e(__("Select User")); ?></option>
                                        <?php if(!empty($apartments)): ?>
                                            
                                           

                                               <?php $__currentLoopData = $apartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $apartment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                       
                                                <option value="<?php echo e($apartment->apartment_id); ?>" 
                                                            <?php echo (old('send_to') == $apartment->apartment_id) ? 'selected' : ''; ?>><?php echo e($apartment->apartment_id); ?></option>
                                                     
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                          
                                            
                                        <?php endif; ?>
                                        
                                    </select>   
                                </div>
                            </div>
                                
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Subject :</label>
                                    <input type="text" name="subject" id="subject" title="Enter subject!" class="district-input-field form-control" placeholder="Subject" required value="<?php echo e(old('subject')); ?>">
                                   
                                </div>
                            </div>

                            
                            
                            <div class="col-xs-12">
                                <div class="form-group clearfix">
                                    <label>Message :</label>
                                    <div class="clearfix">
                                        <textarea  name="message" id="txtEditor" title="enter message!" class=" form-control" rows="8" cols="20" placeholder="Message"
                                             ><?php echo e(old('message')); ?></textarea>     
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12">   
                                <div class="form-group">
                                    <label>Upload File (jpg,png,pdf):</label>
                                    <input type="file" name="attachment_url" id="attachment_url"  class="district-input-field form-control"  >
                                </div>
                            </div>  

                               

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                   <?php echo e(__('Send Message')); ?> 
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    jQuery(document).on("change","select#send_type",function(){
        var send_type = jQuery(this).val();       
        var data = {send_type:send_type};
        var url = "/messages/get-user-dropdown";
        
        
        
        if(send_type == 'apartment'){
            jQuery(".send-to").removeClass('hidden');
            
            ajaxPostRequest(url,data,setUsersDropDown,true);
            $("select#send_to").select2();
        }else if(send_type == 'vendor'){
            jQuery(".send-to").removeClass('hidden');
            ajaxPostRequest(url,data,setUsersDropDown,true);
            $("select#send_to").select2();
             
        }else{
            jQuery(".send-to").addClass('hidden');
        }
    });
    function setUsersDropDown(response){

        if(response.success){
            jQuery("#send_to").html(response.html);
        }        

    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/messages/create.blade.php ENDPATH**/ ?>