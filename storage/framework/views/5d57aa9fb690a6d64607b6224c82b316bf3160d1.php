<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e(__("New Message Received")); ?></title>
</head>
<body>
<h2><?php echo e(__("Admin from Rosen i Vara has sent you a message")); ?></h2>


<p><strong>Name:</strong> <?php echo e($user->fullname); ?></p>

<p><strong>Message:</strong></p>
<p style="font-size:14px;"><?php echo $messageBody; ?></p>

<?php if($attachment): ?>
<br>
<p><a href="<?php echo url('public'); ?>/<?php echo e($attachment); ?>" target="_blank"><?php echo e(__("View Attachment")); ?></a></p>
<?php endif; ?>

<br><br><br>

<p><a href="<?php echo url('/'); ?>/" target="_blank"><?php echo e(config('app.name')); ?> Team</a></p>

</body>

</html>
<?php /**PATH D:\wamp64\www\rosen\resources\views/admin/email/message_from_admin.blade.php ENDPATH**/ ?>