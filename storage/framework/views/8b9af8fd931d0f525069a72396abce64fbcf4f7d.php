<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Trip')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Trip')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('travel create')): ?>
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create New Trip')); ?>" data-url="<?php echo e(route('trip.create')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
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
                                <?php if(in_array(\Auth::user()->type, \Auth::user()->not_emp_type)): ?>
                                    <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th><?php echo e(__('Purpose of Trip')); ?></th>
                                <th><?php echo e(__('Country')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('travel edit') || Gate::check('travel delete')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $travels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $travel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if(in_array(\Auth::user()->type, \Auth::user()->not_emp_type)): ?>
                                    <td><?php echo e(!empty( Modules\Hrm\Entities\Employee::getEmployee($travel->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($travel->user_id)->name : '--'); ?></td>
                                <?php endif; ?>
                                <td><?php echo e(company_date_formate($travel->start_date)); ?></td>
                                <td><?php echo e(company_date_formate($travel->end_date)); ?></td>
                                <td><?php echo e($travel->purpose_of_visit); ?></td>
                                <td><?php echo e($travel->place_of_visit); ?></td>
                                <td>
                                    <p style="white-space: nowrap;
                                        width: 200px;
                                        overflow: hidden;
                                        text-overflow: ellipsis;"><?php echo e(!empty($travel->description) ? $travel->description : ''); ?>

                                    </p>
                                </td>
                                <?php if(Gate::check('travel edit') || Gate::check('travel delete')): ?>
                                    <td class="Action">
                                        <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('travel edit')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                        data-url="<?php echo e(URL::to('trip/' . $travel->id . '/edit')); ?>"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                        data-title="<?php echo e(__('Edit Trip')); ?>"
                                                        data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('travel delete')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                    <?php echo e(Form::open(array('route'=>array('trip.destroy', $travel->id),'class' => 'm-0'))); ?>

                                                    <?php echo method_field('DELETE'); ?>
                                                        <a 
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"  data-confirm-yes="delete-form-<?php echo e($travel->id); ?>"><i
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


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\koristu\Modules/Hrm\Resources/views/travel/index.blade.php ENDPATH**/ ?>