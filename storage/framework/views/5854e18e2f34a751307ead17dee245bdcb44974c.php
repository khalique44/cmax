
<?php if($messages->count()>0): ?>
  <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <li class="<?php echo ($message->is_read > 0) ? 'nactive' : 'active'; ?>" title="<?php echo ($message->is_read > 0) ? '' : __('New Message'); ?>">

      <strong><?php echo e($message->subject); ?> </strong> 
      <?php if($message->created_at !== $message->updated_at): ?>
       <i class="fa fa-pencil text-secondary" title="Editted"></i>
      <?php endif; ?>
      <br>
      <span class="label label-default small text-muted text-left"><?php echo e($message->updated_at); ?></span>
      <br>

      <?php echo $message->message; ?>

      <br>

      <?php if($message->attachment): ?>
      <a href="<?php echo e($message->attachment); ?>" target="_blank" class="label label-success"><?php echo e(__("View Attachment")); ?></a>
      <?php endif; ?>
    </li>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<li><h3><?php echo e(__("No messages found.")); ?></h3></li>
<?php endif; ?>


<?php /**PATH D:\wamp64\www\rosen\resources\views/account/messages.blade.php ENDPATH**/ ?>