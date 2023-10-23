<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Deals')); ?> <?php if($pipeline): ?>
        - <?php echo e($pipeline->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>">
    <style>
        .comp-card {
            height: 140px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal move')): ?>
        <?php if($pipeline): ?>
            <script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>
            <script>
                ! function(a) {
                    "use strict";
                    var t = function() {
                        this.$body = a("body")
                    };
                    t.prototype.init = function() {
                        a('[data-plugin="dragula"]').each(function() {
                            var t = a(this).data("containers"),
                                n = [];
                            if (t)
                                for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]);
                            else n = [a(this)[0]];
                            var r = a(this).data("handleclass");
                            r ? dragula(n, {
                                moves: function(a, t, n) {
                                    return n.classList.contains(r)
                                }
                            }) : dragula(n).on('drop', function(el, target, source, sibling) {

                                var order = [];
                                $("#" + target.id + " > div").each(function() {
                                    order[$(this).index()] = $(this).attr('data-id');
                                });

                                var id = $(el).attr('data-id');

                                var old_status = $("#" + source.id).data('status');
                                var new_status = $("#" + target.id).data('status');
                                var stage_id = $(target).attr('data-id');
                                var pipeline_id = '<?php echo e($pipeline->id); ?>';

                                $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div")
                                    .length);
                                $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div")
                                    .length);
                                $.ajax({
                                    url: '<?php echo e(route('deals.order')); ?>',
                                    type: 'POST',
                                    data: {
                                        deal_id: id,
                                        stage_id: stage_id,
                                        order: order,
                                        new_status: new_status,
                                        old_status: old_status,
                                        pipeline_id: pipeline_id,
                                        "_token": $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(data) {
                                        toastrs('<?php echo e(__('Success')); ?>', 'Deal Move Successfully!',
                                            'success');
                                    },
                                    error: function(data) {
                                        data = data.responseJSON;
                                        toastrs('Error', data.error, 'error')
                                    }
                                });
                            });
                        })
                    }, a.Dragula = new t, a.Dragula.Constructor = t
                }(window.jQuery),
                function(a) {
                    "use strict";

                    a.Dragula.init()

                }(window.jQuery);
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <script>
        $(document).on("change", "#change-pipeline select[name=default_pipeline_id]", function() {
            $('#change-pipeline').submit();
        })
    </script>


<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Deals')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-action'); ?>
    <?php if($pipeline): ?>
        <div class="col-auto">
            <?php echo e(Form::open(['route' => 'deals.change.pipeline', 'id' => 'change-pipeline'])); ?>

            <?php echo e(Form::select('default_pipeline_id', $pipelines, $pipeline->id, ['class' => 'form-control custom-form-select mx-2', 'id' => 'default_pipeline_id'])); ?>

            <?php echo e(Form::close()); ?>

        </div>
    <?php endif; ?>
    <div class="col-auto pe-0 pt-2 px-1">
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal import')): ?>
        <div class="col-auto pe-0 pt-2 px-1">
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Deal Import')); ?>"
                data-url="<?php echo e(route('deal.file.import')); ?>" data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i
                    class="ti ti-file-import"></i>
            </a>
        </div>
    <?php endif; ?>

    <div class="col-auto pe-0 pt-2 px-1">
        <a href="<?php echo e(route('deals.list')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('List View')); ?>"
            class="btn btn-sm btn-primary btn-icon"><i class="ti ti-list"></i> </a>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal create')): ?>
        <div class="col-auto ps-1 pt-2">
            <a class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?php echo e(__('Create Deal')); ?>" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create Deal')); ?>"
                data-url="<?php echo e(route('deals.create')); ?>"><i class="ti ti-plus text-white"></i></a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($pipeline): ?>
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20"><?php echo e(__('Total Deals')); ?></h6>
                                <h3 class="text-primary"><?php echo e($cnt_deal['total']); ?></h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rocket bg-success text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20"><?php echo e(__('This Month Total Deals')); ?></h6>
                                <h3 class="text-info"><?php echo e($cnt_deal['this_month']); ?></h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rocket bg-info text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20"><?php echo e(__('This Week Total Deals')); ?></h6>
                                <h3 class="text-warning"><?php echo e($cnt_deal['this_week']); ?></h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rocket bg-warning text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20"><?php echo e(__('Last 30 Days Total Deals')); ?></h6>
                                <h3 class="text-danger"><?php echo e($cnt_deal['last_30days']); ?></h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rocket bg-danger text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php
                    $stages = $pipeline->dealStages;
                    $json = [];
                    foreach ($stages as $stage) {
                        $json[] = 'task-list-' . $stage->id;
                    }
                ?>
                <div class="row kanban-wrapper horizontal-scroll-cards" data-plugin="dragula"
                    data-containers='<?php echo json_encode($json); ?>'>
                    <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($deals = $stage->deals()); ?>
                        <div class="col" id="progress">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        <button class="btn btn-sm btn-primary btn-icon count">
                                            <?php echo e(count($deals)); ?>

                                        </button>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($stage->name); ?></h4>
                                </div>
                                <div id="task-list-<?php echo e($stage->id); ?>" data-id="<?php echo e($stage->id); ?>"
                                    class="card-body kanban-box">
                                    <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($deal->id); ?>">
                                            <?php ($labels = $deal->labels()); ?>
                                            <div class="pt-3 ps-3">
                                                <?php if($labels): ?>
                                                    <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="badge bg-<?php echo e($label->color); ?> p-2 px-3 rounded">
                                                            <?php echo e($label->name); ?></div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-header border-0 pb-0 position-relative">
                                                <h5><a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal show')): ?> <?php if($deal->is_active): ?> <?php echo e(route('deals.show', $deal->id)); ?> <?php else: ?> # <?php endif; ?> <?php else: ?> # <?php endif; ?>"
                                                        class="text-body text-primary"><?php echo e($deal->name); ?> </a></h5>
                                                <?php if(Auth::user()->type != 'client' && Auth::user()->type != 'staff'): ?>
                                                    <div class="card-header-right">
                                                        <div class="btn-group card-option">
                                                            <?php if(!$deal->is_active): ?>
                                                                <div class="btn dropdown-toggle">
                                                                    <a href="#" class="action-item"
                                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                                            class="fas fa-lock"></i></a>
                                                                </div>
                                                            <?php else: ?>
                                                                <button type="button" class="btn dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="ti ti-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal edit')): ?>
                                                                        <a data-url="<?php echo e(URL::to('deals/' . $deal->id . '/labels')); ?>"
                                                                            data-ajax-popup="true"
                                                                            data-title="<?php echo e(__('Labels')); ?>"
                                                                            class="dropdown-item"><?php echo e(__('Labels')); ?></a>
                                                                        <a data-url="<?php echo e(URL::to('deals/' . $deal->id . '/edit')); ?>"
                                                                            data-size="lg" data-ajax-popup="true"
                                                                            data-title="<?php echo e(__('Edit Deal')); ?>"
                                                                            class="dropdown-item"><?php echo e(__('Edit')); ?></a>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal delete')): ?>
                                                                        <?php echo Form::open([
                                                                            'method' => 'DELETE',
                                                                            'route' => ['deals.destroy', $deal->id],
                                                                            'id' => 'delete-form-' . $deal->id,
                                                                        ]); ?>

                                                                        <a class="dropdown-item show_confirm">
                                                                            <?php echo e(__('Delete')); ?>

                                                                        </a>
                                                                        <?php echo Form::close(); ?>

                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Product"><i
                                                                class="f-16 text-primary ti ti-list"></i><?php echo e(count($deal->tasks)); ?>/<?php echo e(count($deal->complete_tasks)); ?>

                                                        </li>
                                                    </ul>
                                                    <div class="user-group">
                                                        <i class="text-primary ti ti-report-money"></i>
                                                        <?php echo e(currency_format_with_sym($deal->price)); ?>

                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Product"><i
                                                                class="f-16 text-primary ti ti-shopping-cart"></i><?php echo e(count($deal->products())); ?>

                                                        </li>
                                                        <li class="list-inline-item d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Source"><i
                                                                class="f-16 text-primary ti ti-social"></i><?php echo e(count($deal->sources())); ?>

                                                        </li>
                                                    </ul>
                                                    <div class="user-group">
                                                        <?php $__currentLoopData = $deal->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img alt="image" data-bs-toggle="tooltip"
                                                                data-bs-original-title="<?php echo e($user->name); ?>"
                                                                data-bs-placement="top" aria-label="<?php echo e($user->name); ?>"
                                                                title="<?php echo e($user->name); ?>"
                                                                <?php if($user->avatar): ?> src="<?php echo e(get_file($user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('uploads/users-avatar/avatar.png')); ?>" <?php endif; ?>
                                                                class="rounded-circle " width="25" height="25">
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\koristu\Modules/Lead\Resources/views/deals/index.blade.php ENDPATH**/ ?>