

    <a href="<?php echo e(route('landingpage.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'landingpage.index') ? ' active' : ''); ?>"><?php echo e(__('Top Bar')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="<?php echo e(route('custom_page.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'custom_page.index') ? ' active' : ''); ?>"><?php echo e(__('Custom Page')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="<?php echo e(route('homesection.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'homesection.index') ? ' active' : ''); ?>"><?php echo e(__('Home')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="<?php echo e(route('features.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'features.index') ? ' active' : ''); ?>"><?php echo e(__('Features')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="<?php echo e(route('review.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'review.index') ? ' active' : ''); ?>"><?php echo e(__('Review')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="<?php echo e(route('screenshots.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'screenshots.index') ? ' active' : ''); ?>"><?php echo e(__('Screenshots')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="<?php echo e(route('dedicated.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'dedicated.index') ? ' active' : ''); ?>"><?php echo e(__('Dedicated')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="<?php echo e(route('buildtech.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'buildtech.index') ? ' active' : ''); ?>"><?php echo e(__('BuildTech')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="<?php echo e(route('packagedetails.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'packagedetails.index') ? ' active' : ''); ?>"><?php echo e(__('Package Details')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="<?php echo e(route('join_us.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'join_us.index') ? ' active' : ''); ?>"><?php echo e(__('Join Us')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="<?php echo e(route('footer.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'footer.index') ? ' active' : ''); ?>"><?php echo e(__('Footer')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <div class="modal fade" id="exampleModalCenter" tabindex="2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ss_modale" role="document">
            <div class="modal-content image_sider_div">
            
            </div>
        </div>
    </div>

    <?php $__env->startPush('css'); ?>
        <?php echo $__env->make('landingpage::layouts.infoimagescss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
        <?php echo $__env->make('landingpage::layouts.infoimagesjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\koristu\Modules/LandingPage\Resources/views/layouts/tab.blade.php ENDPATH**/ ?>