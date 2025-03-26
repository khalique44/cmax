<option value=""><?php echo ($send_type == 'vendor') ? __('Select Vendor') : __('Select Apartment'); ?></option>

<?php if(!empty($users)): ?>
	<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($send_type != 'vendor'): ?>
			<option value="<?php echo e($user->apartment_id); ?>"><?php echo e($user->apartment_id); ?></option>
		<?php else: ?>
		<option value="<?php echo e($user->id); ?>"><?php echo e($user->full_name); ?> <?php if($send_type != 'vendor'): ?> (<?php echo e($user->username); ?>) <?php endif; ?></option>
		<?php endif; ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/messages/users_dropdown.blade.php ENDPATH**/ ?>