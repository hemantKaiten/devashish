<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Transfer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Transfer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transfer create')): ?>
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create New Transfer')); ?>" data-url="<?php echo e(route('transfer.create')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
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
                                <th><?php echo e(!empty(company_setting('hrm_branch_name')) ? company_setting('hrm_branch_name') : __('Branch')); ?></th>
                                <th><?php echo e(!empty(company_setting('hrm_department_name')) ? company_setting('hrm_department_name') : __('Department')); ?></th>
                                <th><?php echo e(__('Transfer Date')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('transfer edit') || Gate::check('transfer delete')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if(in_array(\Auth::user()->type, \Auth::user()->not_emp_type)): ?>
                                    <td><?php echo e(!empty( Modules\Hrm\Entities\Employee::getEmployee($transfer->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($transfer->user_id)->name : '--'); ?></td>
                                <?php endif; ?>
                                <td><?php echo e(!empty($transfer->branch_id) ? ($transfer->branch->name ) ?? '--' : ''); ?></td>
                                <td><?php echo e(!empty($transfer->department_id) ? ($transfer->department->name ) ?? '--' : ''); ?></td>
                                <td><?php echo e(company_date_formate($transfer->transfer_date)); ?></td>
                                <td>
                                    <p style="white-space: nowrap;
                                        width: 200px;
                                        overflow: hidden;
                                        text-overflow: ellipsis;"><?php echo e(!empty($transfer->description) ? $transfer->description : ''); ?>

                                    </p>
                                </td>
                                <?php if(Gate::check('transfer edit') || Gate::check('transfer delete')): ?>
                                    <td class="Action">
                                        <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transfer edit')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                        data-url="<?php echo e(URL::to('transfer/' . $transfer->id . '/edit')); ?>"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                        data-title="<?php echo e(__('Edit Transfer')); ?>"
                                                        data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transfer delete')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                    <?php echo e(Form::open(array('route'=>array('transfer.destroy', $transfer->id),'class' => 'm-0'))); ?>

                                                    <?php echo method_field('DELETE'); ?>
                                                        <a 
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"  data-confirm-yes="delete-form-<?php echo e($transfer->id); ?>"><i
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
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $(document).on('change', '#branch_id', function(){
            var branch_id = $(this).val();
            getDepartment(branch_id);
        });
        function getDepartment(branch_id)
        {
            var data = {
                "branch_id": branch_id,
                "_token": "<?php echo e(csrf_token()); ?>",
            }
            $.ajax({
                url: '<?php echo e(route('employee.getdepartment')); ?>',
                method: 'POST',
                data: data,
                success: function(data) {
                    $('#department_id').empty();
                    $('#department_id').append('<option value="" disabled><?php echo e(__('Select Department')); ?></option>');

                    $.each(data, function(key, value) {
                        $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    $('#department_id').val('');
                }
            });
        }
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\koristu\Modules/Hrm\Resources/views/transfer/index.blade.php ENDPATH**/ ?>