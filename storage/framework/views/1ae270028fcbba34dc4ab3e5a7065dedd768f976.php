<?php
    $old_path = url("/Modules/".$slug."/marketplace/");
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.getElementById('product_main_banner').onchange = function () {
                var src = URL.createObjectURL(this.files[0])
                document.getElementById('image').src = src
            }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $__env->make('landingpage::marketplace.modules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card sticky-top" style="top:30px">
                            <div class="list-group list-group-flush" id="useradd-sidenav">
                                <?php echo $__env->make('landingpage::marketplace.tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Marketplace Home')); ?></h5>
                                </div>
                                <div id="p1" class="col-auto text-end text-primary h3">
                                    <a image-url="<?php echo e(get_file('Modules/LandingPage/Resources/assets/infoimages/product_main.png')); ?>"
                                       data-url="<?php echo e(route('info.image.view',['marketplace','product_main'])); ?>" class="view-images pt-2">
                                        <i class="ti ti-info-circle pointer"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::open(array('route' => array('product_main_store',$slug), 'method'=>'post', 'enctype' => "multipart/form-data"))); ?>

                            <div class="card-body">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo e(Form::label('Heading', __('Heading'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('product_main_heading',Module_Alias_Name($slug), ['class' => 'form-control ', 'placeholder' => __('Enter Heading')])); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo e(Form::label('Description', __('Description'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::textarea('product_main_description', $settings['product_main_description'], ['class' => 'ckdescription form-control', 'placeholder' => __('Enter Description'), 'id'=>'','required'=>'required'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <?php echo e(Form::label('Live Demo button Link', __('Live Demo button Link'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('product_main_demo_link',$settings['product_main_demo_link'], ['class' => 'form-control', 'placeholder' => __('Enter Link')])); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo e(Form::label('Live Demo Button Text', __('Live Demo Button Text'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('product_main_demo_button_text',$settings['product_main_demo_button_text'], ['class' => 'form-control', 'placeholder' => __('Enter Button Text')])); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <?php echo e(Form::label('Banner', __('Banner'), ['class' => 'form-label'])); ?>

                                            <div class="logo-content mt-4">
                                                <img id="image" src="<?php echo e(check_file($settings['product_main_banner']) ? get_file($settings['product_main_banner']) : $old_path."/image1.png"); ?>"
                                                    class="big-logo" width="100%">
                                            </div>
                                            <div class="choose-files mt-5">
                                                <label for="product_main_banner">
                                                    <div class=" bg-primary " style="cursor: pointer;">
                                                        <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                    </div>
                                                    <input type="file" name="product_main_banner" id="product_main_banner" class="form-control choose_file_custom" data-filename="product_main_banner">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                
                    </div>
                </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="<?php echo e(asset('Modules/LandingPage/Resources/assets/js/editorplaceholder.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $.each($('.ckdescription'), function(i, editor) {
                CKEDITOR.replace(editor, {
                    // contentsLangDirection: 'rtl',
                    extraPlugins: 'editorplaceholder',
                    editorplaceholder: editor.placeholder
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\koristu\Modules/LandingPage\Resources/views/marketplace/product_main/index.blade.php ENDPATH**/ ?>