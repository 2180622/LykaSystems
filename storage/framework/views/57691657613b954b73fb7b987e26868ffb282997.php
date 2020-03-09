<?php $__env->startSection('title', 'Página Exemplo'); ?>


<?php $__env->startSection('styleLinks'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <form method="POST" action="<?php echo e(route('users.store')); ?>" class="form-group"
   enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <?php echo $__env->make('users.partials.add-edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="form-group">
  <button type="submit" class="btn btn-success" name="ok">Save</button>
  <a href="<?php echo e(route('users.index')); ?>" class="btn btn-default">Cancel</a>
  </div>
  </form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/joseareia/Desktop/LykaSystems/resources/views/users/add.blade.php ENDPATH**/ ?>