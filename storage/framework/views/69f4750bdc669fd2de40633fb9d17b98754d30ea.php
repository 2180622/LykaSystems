<?php $__env->startSection('title', 'Lista de utilizadores'); ?>





<?php $__env->startSection('styleLinks'); ?>

<?php $__env->stopSection(); ?>






<?php $__env->startSection('content'); ?>




<h3>Lista de utilizadores</h3>

<button type="button" name="button"><a href="<?php echo e(route('users.create')); ?>">Adicionar Cliente</a></button>





<?php $__env->stopSection(); ?>








<?php $__env->startSection('scripts'); ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/joseareia/Desktop/LykaSystems/resources/views/users/list.blade.php ENDPATH**/ ?>