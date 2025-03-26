

  
<?php $__env->startSection('content'); ?>

<?php if(!empty($header_image)): ?>



<?php endif; ?>

  <header class="header-main header-inner" <?php echo !empty($header_image) ? 'style="background: url('.$header_image.'); min-height: 63vh"' : ""; ?> >
      <div class="container">
      
          <?php echo $__env->make('layouts.includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          
          <div class="slid-header pt-md-2 pb-md-4 mx-auto">

            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                 <h1 class="display-4 mt-2 mt-md-5 mt-lg-5"><?php echo e(__('Reported')); ?> <span><?php echo e(__('Issue')); ?></span></h1>

              </div>

            </div>

           

          </div>          

      </div>
  </header>

  <div class="content">
    <section class="logarea pt-md-5 pb-md-5">

      <div class="container">
        <div class="row"><a href="<?php echo e(url('dashboard')); ?>" class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2"><?php echo e(__('language.Back')); ?></a></div>
        <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
      <div class="ajax-msg"></div>
      <div class="row pb-md-5 justify-content-center">       


        <div class="col-md-12">         
          
          <div class="loundry-bookingtab table-responsive">
              <?php if($records->count() > 0): ?>
                <table class="table table-striped">

                  <thead>

                    <tr>

                      <th><?php echo e(__('language.Report Date')); ?></th>

                      <th><?php echo e(__('language.Reason')); ?></th>

                      <th><?php echo e(__('language.Issue')); ?></th>

                      <th><?php echo e(__('language.Description')); ?></th>

                      <th><?php echo e(__('language.Status')); ?></th>

                      <th><?php echo e(__('language.Attachment')); ?></th>                      

                      

                      <th><?php echo e(__('Granska ärende')); ?></th>

                    </tr>

                  </thead>

                  <tbody>

                   
                      <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                          <td><?php echo e($record->created_at); ?></td>

                          <td  ><?php echo e($record->reason->title); ?></td>

                          <td width=""><?php echo e($record->room_area); ?></td>

                          <td width=""><?php echo e($record->description); ?></td>

                          <td>

                            <?php if(Config::get('constants.issue_status.close') == $record->issue_status): ?>
                            <span class="badge badge-success"><?php echo e($record->issue_status); ?></span>
                            <?php elseif(Config::get('constants.issue_status.inprogress') == $record->issue_status): ?>
                            <span class="badge badge-primary"><?php echo e($record->issue_status); ?></span>
                            <?php elseif(Config::get('constants.issue_status.new') == $record->issue_status): ?>
                            <span class="badge badge-danger"><?php echo e($record->issue_status); ?></span>
                            <?php elseif(Config::get('constants.issue_status.verification') == $record->issue_status): ?>
                            <span class="badge badge-warning"><?php echo e($record->issue_status); ?></span>
                            <?php endif; ?>
                          </td>
                          

                          <td>
                          <?php if($record->issuesAttachments->count() > 0): ?>
                            <?php $__currentLoopData = $record->issuesAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($key+1); ?>.
                            <a href="#" data-toggle="modal" data-target="#attachment-model-<?php echo e($attachment->id); ?>"> <?php echo e(__('language.Attachment')); ?></a><br>

                            <div class="modal fade" id="attachment-model-<?php echo e($attachment->id); ?>" tabindex="-1" role="dialog" aria-labelledby="attachment-model-<?php echo e($attachment->id); ?>" aria-hidden="true">

                              <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >

                                <div class="modal-content">

                                  <button type="button" class="btn btn-link close cl" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                  </button>

                                  <div class="modal-body">

                                    <p class="text-center"><img src="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>" width="100%" ></p>

                                   

                                    <div class="text-center pt-md-4"><a class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2" href="javascript:;" data-dismiss="modal"><?php echo e(__('OK')); ?></a></div>

                                  </div>

                                  

                                </div>

                              </div>

                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                          </td>

                          

                          

                          <td  ><a href="<?php echo e(url('report-issue/')); ?>/<?php echo e($record->id); ?>/edit/" class="text-success" title="<?php echo e(__('language.View Record')); ?>"><i class="fa fa-eye"></i></a>        
                           <?php if($record->issues_comments_count > 0): ?>
                            | <a href="<?php echo e(url('report-issue/')); ?>/<?php echo e($record->id); ?>/edit/#comments" class="badge badge-warning"><?php echo e($record->issues_comments_count); ?> <?php echo e(__('language.New Comments')); ?> </a>
                           <?php endif; ?>

                         </td>

                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       

                  </tbody>

                </table>
              <?php else: ?>
                <h3 class="mt-5"><?php echo e(__('language.No record found')); ?></h3> 
              <?php endif; ?> 
          </div>

        </div>



      </div>

      </div>

    </section>
  </div>
  <!---content--->


  <!-- Modal -->

  <div class="modal fade sever-modal" id="severelight" tabindex="-1" role="dialog" aria-labelledby="severelight" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

      <div class="modal-content">

        <button type="button" class="btn btn-link close cl" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <div class="modal-body">

          <h4 class="text-center">When Having a Severe Issue<br>Call/SMS: 0738300666</h4>

          <h6 class="text-center">OR</h6>

          <h4 class="text-center">Call 112</h4>

          <div class="text-center pt-md-4"><a class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2" href="javascript:;" data-dismiss="modal">OK</a></div>

        </div>

        

      </div>

    </div>

  </div>

  <div class="modal fade" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> <?php echo e(__('language.This action can not be un-done, Are you sure you want to permanently Remove this?')); ?> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                

                <form style="display: inline-block;" type="hidden" class="data-delete-form" method="POST" action="">
                    <?php echo e(method_field('DELETE' )); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="action-buttons">
                        <button type="submit" class="btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  

   <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
  
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/report_issues/vendor/index.blade.php ENDPATH**/ ?>