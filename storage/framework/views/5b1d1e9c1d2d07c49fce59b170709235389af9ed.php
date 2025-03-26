<?php



$header_logo = App\Http\Helpers\RosenHelper::getOption('header_logo');



?>



<nav class="navbar navbar-expand-md navbar-dark" id="navbar">

  <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img src="<?php if(!empty($header_logo)): ?>  <?php echo url('public'); ?>/<?php echo e($header_logo); ?> <?php else: ?> <?php echo url('public/assets/images/logo-white.png'); ?> <?php endif; ?>"></a>

  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>

  <div class="navbar-collapse collapse" id="navbarCollapse" style="">

    <ul class="navbar-nav ml-auto">

      <li class="nav-item active">

        <a class="nav-link" href="<?php echo e(url('/home')); ?>">Hem</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="<?php echo e(url('/omboende')); ?>">Om Boende</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="<?php echo e(url('/forboende')); ?>">För Boende</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="<?php echo e(url('/blog')); ?>">Blogg</a>

      </li>
      
      <li class="nav-item">

        <a class="nav-link btn btn-success" href="<?php echo e(url('/kontakta')); ?>">Kontakta Oss</a>

      </li>
      <?php if(auth()->guard('web')->check()): ?>

      
      <li class="nav-item"><a class="nav-link btn btn-success btn-inverse" href="<?php echo e(url('/logout')); ?>"><?php echo e(__('language.Logga Out')); ?></a></li>

      <!-- <li class="nav-item dropdown">
        <a class="nav-link btn btn-success btn-inverse dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" href="#"><?php echo e(__('language.My Account')); ?></a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="<?php echo e(url('/dashboard')); ?>"><?php echo e(__('language.Dashboard')); ?></a></li>
          <li><a class="dropdown-item" href="<?php echo e(url('/logout')); ?>"><?php echo e(__('language.Logga Out')); ?></a></li>
        </ul>
      </li> -->
     
      <?php endif; ?>


      <?php if(auth()->guard()->guest()): ?>

      <li class="nav-item">
        <a class="nav-link btn btn-success btn-inverse" href="<?php echo e(url('/login')); ?>">Logga In</a>
      </li>

      <?php endif; ?>
      
    </ul>

    

  </div>

</nav><?php /**PATH D:\wamp64\www\rosen\resources\views/layouts/includes/nav.blade.php ENDPATH**/ ?>