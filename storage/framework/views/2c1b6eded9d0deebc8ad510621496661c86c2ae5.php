<option value=""><?php echo e(__('Select Day')); ?></option>
<?php if(!empty($days)): ?>
    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <option value="<?php echo e($day); ?>" <?php echo old('day') == $day ? 'selected' : ''; ?>><?php echo e($day); ?></option>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/available_time_slots/days_dropdown.blade.php ENDPATH**/ ?>