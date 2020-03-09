<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?php echo $__env->yieldContent('title'); ?> | lyka.</title>

    <!-- Favicon -->
    

    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Fontawesome core CSS -->
    <link href="<?php echo e(asset('/vendor/fontawesome-free/css/all.min.css')); ?>" rel=" stylesheet" type="text/css">

    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Link -->
    <link href="<?php echo e(asset('/css/master.css')); ?>" rel="stylesheet">

    <script src="https://unpkg.com/feather-icons"></script>

    <?php echo $__env->yieldContent('styleLinks'); ?>

</head>

<body>

    <!-- Structure and Navigation -->
    <div class="container-fluid ">
        <div class="row" style="min-height:100vh">

            <!-- Left Sidebar -->
            <div class="col main-menu shadow">
                <?php echo $__env->make('layout.partials.main-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- Content -->
            <div class="col pb-5 pt-3">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <!-- Right Sidebar -->
            <div class="col sidebar shadow">
                <?php echo $__env->make('layout.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <?php echo $__env->make('layout.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH /home/joseareia/Desktop/LykaSystems/resources/views/layout/master.blade.php ENDPATH**/ ?>