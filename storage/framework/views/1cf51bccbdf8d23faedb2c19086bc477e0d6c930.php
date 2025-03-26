

  
<?php $__env->startSection('content'); ?>

<?php if(!empty($header_image)): ?>



<?php endif; ?>

  <header class="header-main header-inner" <?php echo !empty($header_image) ? 'style="background: url('.$header_image.'); min-height: 63vh"' : ""; ?> >
      <div class="container">
      
          <?php echo $__env->make('layouts.includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          
          <div class="slid-header pt-md-2 pb-md-4 mx-auto">

            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                 <h1 class="display-4 mt-2 mt-md-5 mt-lg-5"><?php if(!empty($data['title'])): ?> <?php echo html_entity_decode($data['title']); ?> <?php endif; ?></span></h1>

              </div>

            </div>

           

          </div>          

      </div>
  </header>

  <div class="content">
    <section class="logarea pt-md-5 pb-md-5">

      <div class="container">
        <div class="row"><a href="<?php echo e(url('dashboard')); ?>" class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2 mb-2"><?php echo e(__('language.Back')); ?></a></div>
        <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row pb-md-4 justify-content-center">

          <div class="col-md-5"><h3><?php echo e(__('language.WRITE ISSUE')); ?></h3></div>

          <div class="col-md-3 text-right"><a href="#" class="btn btn-success2" data-toggle="modal" data-target="#severelight"><?php echo e(__('language.SEVERE ISSUE')); ?></a></div>

        </div>
      <div class="ajax-msg"></div>
      <div class="row pb-md-5 justify-content-center">

        <div class="col-md-8">
         

          <form method="POST" enctype="multipart/form-data" id="report-issue-form">
           
            <div class="row">

              <div class="col-md-6">

                <div class="form-group">
                  <label><?php echo e(__('language.Select Reason')); ?> *:</label>
                  <select   name="reason_id"   class="form-control" required>
                    <option value=""><?php echo e(__('language.Select Reason')); ?></option>
                    <?php if($issueReasons->count() > 0): ?>
                      <?php $__currentLoopData = $issueReasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($reason->id); ?>"><?php echo e($reason->title); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label><?php echo e(__('language.Describe Where')); ?> *:</label>
                  <input type="text" name="room_area" placeholder="<?php echo e(__('language.Describe Where')); ?> *" class="form-control" required>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label><?php echo e(__('language.Describe Issue')); ?> *:</label>
                  <input type="text" name="description" placeholder="<?php echo e(__('language.Describe Issue')); ?> *" class="form-control" required>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label><?php echo e(__('language.Upload Attachment')); ?> :</label>
                  <div class="choose-file-area">
                    <label  for="attachment"><?php echo e(__('VÄLJ BILD')); ?></label>
                  </div>
                  <div class="show-fake-file-name "></div>
                 <input type="file" name="attachment" placeholder="<?php echo e(__('language.Upload Attachment')); ?>" class="form-control hidden" id="attachment" style="visibility:hidden;">


                </div>

              </div>
              
              <div class="col-md-6">

                <div class="form-group">

                  <?php if($apartmentUsers->count() > 1): ?>
                    <label><?php echo e(__('language.Select Member (Full Name)')); ?> *:</label>
                    <select name="full_name" class="form-control">
                      <option value=""><?php echo e(__('language.Select Member (Full Name)')); ?></option>
                      <?php $__currentLoopData = $apartmentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $apartmentUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        

                          <option value="<?php echo e($apartmentUser->first_name); ?> <?php echo e($apartmentUser->last_name); ?>" data-email="<?php echo e($apartmentUser->email); ?>" data-phone="<?php echo e($apartmentUser->phone); ?>"><?php echo e($apartmentUser->first_name); ?> <?php echo e($apartmentUser->last_name); ?></option>                        

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  <?php else: ?> 
                    <label><?php echo e(__('language.Member Full Name')); ?> :</label>
                    <input type="text" name="full_name" placeholder="<?php echo e(__('language.Member Full Name')); ?>" class="form-control" value="<?php echo e($full_name); ?>" readonly="" >

                  <?php endif; ?>

                  

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label><?php echo e(__('language.Phone')); ?> :</label>
                  <input type="phone" name="phone" placeholder="<?php echo e(__('language.Phone')); ?>" class="form-control" value="<?php echo e($phone); ?>" readonly="">

                </div>

              </div>

              <div class="col-md-12">

                <div class="form-group">
                  <label><?php echo e(__('E-POST')); ?> :</label>
                  <input type="email" name="email" placeholder="<?php echo e(__('E-POST')); ?>" class="form-control"   <?php echo e($email); ?> readonly="">

                </div>

              </div>

              

              <div class="col-md-12">

                <div class="form-group">
                  <label><?php echo e(__('language.Describe More')); ?> :</label>
                  <textarea name="more_description" placeholder="<?php echo e(__('language.Describe More')); ?>" class="form-control" rows="6" ></textarea>

                </div>

              </div>

              <div class="col-md-12 text-center">

                <div class="form-group ">

                  <button type="submit" class="btn btn-warning pl-md-5 pr-md-5 pt-md-2 pb-md-2"><?php echo e(__('SKICKA IN ÄRENDET')); ?></button>

                </div>

              </div>

            </div>

           

          </form>

        </div>



        <div class="col-md-12">

          <hr>

          <h3><?php echo e(__('language.REPORTED ISSUE')); ?></h3>

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

                      <th><?php echo e(__('language.Action')); ?></th>

                    </tr>

                  </thead>

                  <tbody>

                    
                      <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     
                        <tr>

                          <td><?php echo e($record->created_at); ?></td>

                          <td  ><?php echo e($record->reason->title); ?></td>

                          <td ><?php echo e($record->room_area); ?></td>

                          <td ><?php echo e($record->description); ?></td>

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
                          

                          <td  ><a href="<?php echo e(url('report-issue/')); ?>/<?php echo e($record->id); ?>/edit/" class="text-success" title="<?php echo e(__('language.Edit/View Record')); ?>"><i class="fa fa-eye"></i></a>
                           <?php 
                            /* | <a  class="text-danger remove_issue" data-id="{{ $record->id }}" data-target="#DeleteConfirmationModal" data-toggle="modal" href="javascript:;"   title="{{ __('language.Remove') }}"><i class="fa fa-trash"></i></a>
                            */
                           ?>
                          
                           <?php if($record->issues_comments_count > 0): ?>
                            | <a href="<?php echo e(url('report-issue/')); ?>/<?php echo e($record->id); ?>/edit/#comments" class="badge badge-warning"><?php echo e($record->issues_comments_count); ?> <?php echo e(__('Nya kommentarer')); ?> </a>
                           <?php endif; ?>

                         </td>

                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                         

                  </tbody>

                </table>
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

          <h4 class="text-center">Vid brådskande ärenden<br>skicka SMS eller ring till: 073-83 00 666</h4>

         

          <div class="text-center pt-md-4"><a class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2" href="javascript:;" data-dismiss="modal"><?php echo e(__('OK')); ?></a></div>

        </div>

        

      </div>

    </div>

  </div>

  <div class="modal fade" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteConfirmationModalLabel"><?php echo e(__('Confirmation')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> <?php echo e(__('language.This action can not be un-done, Are you sure you want to permanently Remove this?')); ?> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal"><?php echo e(__('language.Close')); ?></button>
                

                <form style="display: inline-block;" type="hidden" class="data-delete-form" method="POST" action="">
                    <?php echo e(method_field('DELETE' )); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="action-buttons pt-3">
                        <button type="submit" class="btn-danger"><?php echo e(__('language.Delete')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  

   <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
  
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/report_issues/index.blade.php ENDPATH**/ ?>