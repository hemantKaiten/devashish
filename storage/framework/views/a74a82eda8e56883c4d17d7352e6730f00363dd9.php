<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Company Policy')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Company Policy')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('attendance create')): ?>
            <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create Company Policy')); ?>" data-url="<?php echo e(route('company-policy.create')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table mb-0 pc-dt-simple" id="assets">
                        <thead>
                            <tr>
                                <th><?php echo e(!empty(company_setting('hrm_branch_name')) ? company_setting('hrm_branch_name') : __('Branch')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Attachment')); ?></th>
                                <?php if(Gate::check('companypolicy edit') || Gate::check('companypolicy delete')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $companyPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(!empty($policy->branches) ? $policy->branches->name : '--'); ?></td>
                                    <td><?php echo e($policy->title); ?></td>
                                    <td >
                                        <p style="white-space: nowrap;
                                            width: 200px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;"><?php echo e(!empty($policy->description) ? $policy->description : ''); ?>

                                        </p>
                                    </td>
                                    <td>
                                        <?php if(!empty($policy->attachment)): ?>
                                        <div class="action-btn bg-primary ms-2">

                                            <a  class="mx-3 btn btn-sm align-items-center" href="<?php echo e(get_file($policy->attachment)); ?>" download="">
                                                <i class="ti ti-download text-white"></i>
                                            </a>
                                        </div>
                                            <div class="action-btn bg-secondary ms-2">
                                                <a class="mx-3 btn btn-sm align-items-center" href="<?php echo e(get_file($policy->attachment)); ?>" target="_blank"  >
                                                    <i class="ti ti-crosshair text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Preview')); ?>"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <p>--</p>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('companypolicy edit') || Gate::check('companypolicy delete')): ?>
                                        <td class="Action">
                                            <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('companypolicy edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a  class="mx-3 btn btn-sm  align-items-center"
                                                            data-url="<?php echo e(URL::to('company-policy/' . $policy->id . '/edit')); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                            data-title="<?php echo e(__('Edit Company Policy')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('companypolicy delete')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo e(Form::open(array('route'=>array('company-policy.destroy', $policy->id),'class' => 'm-0'))); ?>

                                                    <?php echo method_field('DELETE'); ?>
                                                        <a 
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"  data-confirm-yes="delete-form-<?php echo e($policy->id); ?>"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
                                                <?php endif; ?>
                                        </span>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\koristu\Modules/Hrm\Resources/views/companyPolicy/index.blade.php ENDPATH**/ ?>