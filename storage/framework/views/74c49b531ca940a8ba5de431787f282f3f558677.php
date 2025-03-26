<option value="">Select Available Time</option>

<?php if(!empty($availableTimeSlots)): ?>
	<?php $__currentLoopData = $availableTimeSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timeSlot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<option value="<?php echo e(App\Http\Helpers\RosenHelper::timeSlotFormat($timeSlot->time_from)); ?> to <?php echo e(App\Http\Helpers\RosenHelper::timeSlotFormat($timeSlot->time_to)); ?>"
		<?php echo App\Http\Helpers\RosenHelper::isSlotAlreadyBooked($alreadyBookedSlots,$timeSlot->time_from,$timeSlot->time_to) ? 'disabled' : ''; ?>

		><?php echo e(App\Http\Helpers\RosenHelper::timeSlotFormat($timeSlot->time_from)); ?> to <?php echo e(App\Http\Helpers\RosenHelper::timeSlotFormat($timeSlot->time_to)); ?></option>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/available_time_slots/option_time_slots.blade.php ENDPATH**/ ?>