<option value=""> 
	<?php if(Auth::user()->isMember()): ?> 
	<?php echo e(__("language.Select Available Time")); ?> 
	<?php else: ?>  
	<?php echo e(__("Select Available Time")); ?> 
	<?php endif; ?> 
</option>

<?php if(!empty($timeFrom)): ?>
	<?php $__currentLoopData = $timeFrom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $from): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php 

			$to = $timeTo[$key];
			$fromHour = explode(":",$from);
			$fromHour = ltrim($fromHour[0], "0");			
			
 			$now = \Carbon\Carbon::now();
 			$hour = $now->hour;
 	
 			$currentDay = $now->day;       
        	$currentMonth = $now->month;
        	$currentYear = $now->year;
        	$currentDate = $currentDay.'/'.$currentMonth.'/'.$currentYear.' '.$hour;

			
 			$currentTimestamp = \Carbon\Carbon::createFromFormat('d/m/Y H', $currentDate)->format('Y-m-d H');
 			$timestamp = \Carbon\Carbon::createFromFormat('d/m/Y H', $selectedDate.' '.$fromHour)->format('Y-m-d H');
 			
		?>
		<?php if($currentTimestamp < $timestamp): ?>
		<option value="<?php echo e($from); ?> till <?php echo e($to); ?>"
			<?php echo App\Http\Helpers\RosenHelper::isSlotAlreadyBooked($alreadyBookedSlots,$from,$to) ? 'disabled class="already-booked" title="Already Booked"' : ''; ?>

			><?php echo e($from); ?> till <?php echo e($to); ?></option>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/available_time_slots/option_time_slots_advance.blade.php ENDPATH**/ ?>