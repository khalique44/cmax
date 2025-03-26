





<?php $__env->startSection('content'); ?>



<?php if(!empty($header_image)): ?>







<?php endif; ?>



<header class="header-main header-inner" <?php echo !empty($header_image) ? 'style="background: url('.$header_image.'); min-height: 63vh"' : ""; ?> >

  <div class="container">



    <?php echo $__env->make('layouts.includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <div class="slid-header pt-md-2 pb-md-4 mx-auto">



      <div class="row">



        <div class="col-lg-12 col-md-12 col-sm-12 text-center">



         <h1 class="display-4 mt-2 mt-md-5 mt-lg-5"><?php echo e(__('Report')); ?> <span><?php echo e(__('Issue')); ?></span></h1>



       </div>



     </div>







   </div>          



 </div>

</header>



<div class="content">

  <section class="logarea pt-md-5 pb-md-5">



    <div class="container">



      <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <div class="row pb-md-4 justify-content-center">



        <div class=""><h3><?php echo e(__('language.VIEW ISSUE')); ?></h3></div>







      </div>

      

      

        <div class="row pb-md-5 justify-content-center">



          <div class="col-md-8">





            <div class="row">



              <div class="col-md-6">



                <div class="form-group">

                  <label><strong><?php echo e(__('language.Where')); ?>: </strong> <?php echo e($record->room_area); ?> </label>

                </div>



              </div>



              <div class="col-md-6">



                <div class="form-group">

                  <label><strong><?php echo e(__('language.Issue')); ?>: </strong> <?php echo e($record->description); ?></label>



                </div>



              </div>



              

              

              <div class="col-md-6">



                <div class="form-group">



                  <label><strong><?php echo e(__('language.Member Name')); ?>:</strong> <?php echo e($record->full_name); ?></label>



                </div>



              </div>



              <div class="col-md-6">



                <div class="form-group">

                  <label><strong><?php echo e(__('language.Contact Number')); ?>:</strong> <?php echo e($record->phone); ?></label>

                  

                </div>



              </div>



              <div class="col-md-6">



                <div class="form-group">

                  <label><strong><?php echo e(__('E-POST')); ?>:</strong> <?php echo e($record->email); ?></label>

                  

                </div>



              </div>



              <div class="col-md-6">



                <div class="form-group">

                  <label><strong><?php echo e(__('language.Status')); ?>:</strong> 

                    <?php if(Config::get('constants.issue_status.close') == $record->issue_status): ?>

                    <span class="badge badge-success"><?php echo e($record->issue_status); ?></span>

                    <?php elseif(Config::get('constants.issue_status.inprogress') == $record->issue_status): ?>

                    <span class="badge badge-primary"><?php echo e($record->issue_status); ?></span>

                    <?php elseif(Config::get('constants.issue_status.new') == $record->issue_status): ?>

                    <span class="badge badge-danger"><?php echo e($record->issue_status); ?></span>

                    <?php elseif(Config::get('constants.issue_status.verification') == $record->issue_status): ?>

                    <span class="badge badge-warning"><?php echo e($record->issue_status); ?></span>

                    <?php endif; ?>

                  </label>

                  

                </div>



              </div>



              <div class="col-md-6">



                <div class="form-group">

                  <label><strong><?php echo e(__('Apartment')); ?> #:</strong> <?php echo e($record->users->username); ?></label>

                  

                </div>



              </div>

              



              <div class="col-md-12">



                <div class="form-group">

                  <label><strong><?php echo e(__('language.More Details')); ?>:</strong> </label>

                  <p><?php echo e($record->more_description); ?></p>

                  

                </div>



              </div>



              <div class="col-md-6">



                <div class="form-group">

                  <label><strong><?php echo e(__('language.Attachments')); ?>:</strong></label>                  

                  

                  <?php if($record->issuesAttachments->count() > 0): ?>

                  <table class="display" id="table_main" width="100%">



                    <?php $__currentLoopData = $record->issuesAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                      <td>

                        <a href="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>" target="_blank">

                          <img src="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>" class="logo mt-2" alt="View File" width="50%">

                        </a>

                      </td>

                    </tr>





                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </table>

                  <?php endif; ?>



                </div>



              </div>

              

              



              <div class="col-md-12">&nbsp;</div>



              <div class="col-md-12">



                <?php if($record->issuesComments->count() > 0): ?>

                <div class="col-md-6"><h3><?php echo e(__('language.Comments')); ?></h3></div>

                <div class="col-md-12" >

                  <table class="display" id="table_main" width="100%">

                    <tr><th><?php echo e(__('language.Comment')); ?></th><th><?php echo e(__('language.Comment By')); ?></th><th><?php echo e(__('language.Date')); ?></th><th></th></tr>

                    

                    <?php $__currentLoopData = $record->issuesComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ket => $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                    <tr><td><?php echo e($comment->comments); ?></td><td><?php echo e(ucfirst($comment->comment_by)); ?></td><td><?php echo e($comment->created_at); ?></td>
                       <td>
                        <?php if($comment->user_id == auth()->user()->id): ?>
                        <a href="#" data-toggle="modal" data-target="#edit-comment-<?php echo e($comment->id); ?>" title="<?php echo e(__('language.Edit Comment')); ?>"> <i class="fa fa-pencil"></i> </a><br>

                        <div class="modal fade" id="edit-comment-<?php echo e($comment->id); ?>" tabindex="-1" role="dialog" aria-labelledby="edit-comment-<?php echo e($comment->id); ?>" aria-hidden="true">

                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >

                            <div class="modal-content">

                              <button type="button" class="btn btn-link close cl" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                              </button>
                              <form method="post" enctype="multipart/form-data" id="edit-comments" data-id="<?php echo e($record->id); ?>" data-comment-id="<?php echo e($comment->id); ?>">
                                <div class="modal-body">

                                  <div class="edit-ajax-msg"></div>

                                  <div class="form-group">

                                    <label><?php echo e(__('language.Edit Comment')); ?>:</label>

                                    <textarea name="edit_comments" placeholder="<?php echo e(__('language.Type Comments')); ?>" title="<?php echo e(__('language.Type Comments')); ?>" class="form-control edit_comments" rows="6" ><?php echo e($comment->comments); ?></textarea>

                                  </div>                               

                                  <div class="text-center pt-md-4">
                                    <a class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2" href="javascript:;" data-dismiss="modal"><?php echo e(__('language.Close')); ?></a>

                                    <button type="submit" class="btn btn-warning pl-md-5 pr-md-5 pt-md-2 pb-md-2"><?php echo e(__('SKICKA IN')); ?></button>

                                  </div>



                                </div>
                              </form>

                              

                            </div>

                          </div>

                        </div>
                        <?php endif; ?>
                      </td>
                    </tr>


                   



                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </table>

                </div>

                <?php endif; ?>

                

              </div>

              <div class="col-md-12" id="comments" >&nbsp;</div>



              <?php if($record->issue_status !== Config('constants.issue_status.close')): ?>

              <div class="col-md-12">
                <form method="post" enctype="multipart/form-data" id="add-comments" data-id="<?php echo e($record->id); ?>">
                  <div class="col-md-12">

                    <div class="ajax-msg"></div>

                    <div class="form-group">

                      <label><?php echo e(__('language.Add New Comment')); ?>:</label>

                      <textarea name="comments" placeholder="<?php echo e(__('language.Type Comments')); ?>" title="<?php echo e(__('language.Type Comments')); ?>" class="form-control comments" rows="6" ></textarea>

                      <?php if(empty($record->is_done)): ?>

                      <label><input type="checkbox" value="1" name="is_done" class="pt-2 is_done"> <?php echo e(__("language.Mark it done")); ?></label>

                      <?php endif; ?>

                    </div>



                  </div>



                  <div class="col-md-12 text-center">



                    <div class="form-group ">



                      <a href="<?php echo e(url('report-issue/')); ?>" class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2 text-light"><?php echo e(__('language.Back')); ?></a>

                      <button type="submit" class="btn btn-warning pl-md-5 pr-md-5 pt-md-2 pb-md-2"><?php echo e(__('SKICKA IN')); ?></button>



                    </div>



                  </div>
                </form>
              </div>

              <?php endif; ?>

              



            </div>

            

          </div>

        



      </div>



    </div>



  </section>

</div>

<!---content--->









<?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/report_issues/vendor/edit.blade.php ENDPATH**/ ?>