<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e(__("New Message Received")); ?></title>
</head>
<body>
<h2><?php echo e(__("Issue Reported by ")); ?> <?php echo e($user->full_name); ?></h2>


<p><strong>Name:</strong> <?php echo e($user->full_name); ?></p>
<p><strong>Reason Title:</strong> <?php echo e($record->reason->title); ?></p>
<p><strong>Issue Type:</strong> <?php echo e($record->issue_type); ?></p>
<p><strong>Issue Status:</strong> <?php echo e($record->issue_status); ?></p>
<p><strong>Issue Description:</strong> <?php echo e($record->description); ?></p>
<?php if($record->more_description): ?>
<br>
<p><strong>More Details:</strong></p>
<p style="font-size:14px;"><?php echo e($record->more_description); ?></p>
<?php endif; ?>

<?php if($attachment): ?>
<br>
<p><a href="<?php echo url('public'); ?>/<?php echo e($attachment); ?>" target="_blank"><?php echo e(__("View Attachment")); ?></a></p>
<?php endif; ?>

<br><br><br>

<p><a href="<?php echo url('/'); ?>/" target="_blank"><?php echo e(config('app.name')); ?> Team</a></p>

</body>

</html>
<?php /**PATH D:\wamp64\www\rosen\resources\views/email/reported_issue_message.blade.php ENDPATH**/ ?>