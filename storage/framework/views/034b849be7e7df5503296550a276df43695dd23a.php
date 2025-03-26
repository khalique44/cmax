<?php

$footer_logo = App\Http\Helpers\RosenHelper::getOption('footer_logo');
$footer_text_under_logo = App\Http\Helpers\RosenHelper::getOption('footer_text_under_logo');
$footer_center_column_heading = App\Http\Helpers\RosenHelper::getOption('footer_center_column_heading');
$footer_last_column_heading = App\Http\Helpers\RosenHelper::getOption('footer_last_column_heading');
$copy_right_text = App\Http\Helpers\RosenHelper::getOption('copy_right_text');
$phone_number = App\Http\Helpers\RosenHelper::getOption('phone_number');
$address = App\Http\Helpers\RosenHelper::getOption('address');
$email_address = App\Http\Helpers\RosenHelper::getOption('email_address');
$google_map_link = App\Http\Helpers\RosenHelper::getOption('google_map_link');
$facebook_url = App\Http\Helpers\RosenHelper::getOption('facebook_url');
$posts = App\Post::where('status','yes')->latest()->take(5)->get();
?>


<footer class="pt-5" id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col1">
        <img src="<?php if(!empty($header_logo)): ?>  <?php echo url('public'); ?>/<?php echo e($header_logo); ?> <?php else: ?> <?php echo url('public/assets/images/logo-white.png'); ?> <?php endif; ?>" class="mb-4">
        <p class="text-light"><?php echo e($footer_text_under_logo); ?></p>
        <div class="social">
            <a href="<?php echo e($facebook_url); ?>" class="social1"><i class="fab fa-facebook-f"></i></a>
          </div>
      </div>
      <div class="col-md-4">
        <h3 class="mb-4"><?php echo e($footer_center_column_heading); ?></h3>
        <ul>
          <?php if(!empty($posts)): ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e(url('blog')); ?>/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </ul>

      </div>

      <div class="col-md-4">
        <h3 class="mb-4"><?php echo e($footer_last_column_heading); ?></h3>
        <p><a href="tel:073-83 00 666"><img src="<?php echo url('public/assets/images/phone-call1.svg'); ?>"> <?php echo e($phone_number); ?></a></p>
        <p><a href="mailto:thomasabardin@hotmail.com"><img src="<?php echo url('public/assets/images/mail1.svg'); ?>"> <?php echo e($email_address); ?></a></p>
        <p><a href="<?php echo e($google_map_link); ?>" target="_blank"><img src="<?php echo url('public/assets/images/placeholder.svg'); ?>"> <?php echo nl2br(e($address)); ?></a></p>

      </div>


    </div>
    
  </div>
  <div class="bottom-bar mt-4 py-3">
      <div class="text-light text-center">
          <?php echo e($copy_right_text); ?>

      </div>
    </div>
</footer>

<a href="#" id="gotop"><i class="fa-solid fa-chevron-up"></i></a>


<?php /**PATH E:\wamp64\www\rosen\resources\views/layouts/includes/footer.blade.php ENDPATH**/ ?>