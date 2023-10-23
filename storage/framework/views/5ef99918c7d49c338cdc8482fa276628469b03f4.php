<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leave')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Leave')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave create')): ?>
            <a class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create New Leave')); ?>"
                data-url="<?php echo e(route('leave.create')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
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
                                    <th><?php echo e(__('Leave Type')); ?></th>
                                    <th><?php echo e(__('Applied On')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('Total Days')); ?></th>
                                    <th><?php echo e(__('Leave Reason')); ?></th>
                                    <th><?php echo e(__('status')); ?></th>
                                    <?php if(Gate::check('leave edit') || Gate::check('leave delete') || Gate::check('leave approver manage')): ?>
                                        <th width="200px"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(in_array(\Auth::user()->type, \Auth::user()->not_emp_type)): ?>
                                            <td><?php echo e(!empty(Modules\Hrm\Entities\Employee::getEmployee($leave->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($leave->user_id)->name : '--'); ?>

                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e(!empty(Modules\Hrm\Entities\Leave::getLeaveType($leave->leave_type_id)) ? Modules\Hrm\Entities\Leave::getLeaveType($leave->leave_type_id)->title : ''); ?>

                                        </td>
                                        <td><?php echo e(company_date_formate($leave->applied_on)); ?></td>
                                        <td><?php echo e(company_date_formate($leave->start_date)); ?></td>
                                        <td><?php echo e(company_date_formate($leave->end_date)); ?></td>

                                        <td><?php echo e($leave->total_leave_days); ?></td>
                                        <td>
                                            <p style="white-space: nowrap;
                                        width: 200px;
                                        overflow: hidden;
                                        text-overflow: ellipsis;">
                                                <?php echo e(!empty($leave->leave_reason) ? $leave->leave_reason : ''); ?>

                                            </p>
                                        </td>
                                        <td>
                                            <?php if($leave->status == 'Pending'): ?>
                                                <div class="badge bg-warning p-2 px-3 rounded status-badge5">
                                                    <?php echo e($leave->status); ?></div>
                                            <?php elseif($leave->status == 'Approved'): ?>
                                                <div class="badge bg-success p-2 px-3 rounded status-badge5">
                                                    <?php echo e($leave->status); ?></div>
                                            <?php else: ?>
                                                <div class="badge bg-danger p-2 px-3 rounded status-badge5">
                                                    <?php echo e($leave->status); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <?php if(Gate::check('leave edit') || Gate::check('leave delete') || Gate::check('leave approver manage')): ?>
                                            <td class="Action">
                                                <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave approver manage')): ?>
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a class="mx-3 btn btn-sm  align-items-center"
                                                                data-url="<?php echo e(URL::to('leave/' . $leave->id . '/action')); ?>"
                                                                data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                                title="" data-title="<?php echo e(__('Manage Leave')); ?>"
                                                                data-bs-original-title="<?php echo e(__('Leave Action')); ?>">
                                                                <i class="ti ti-caret-right text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if($leave->status == 'Pending'): ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="<?php echo e(URL::to('leave/' . $leave->id . '/edit')); ?>"
                                                                    data-ajax-popup="true" data-size="md"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="<?php echo e(__('Edit Leave')); ?>"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo e(Form::open(['route' => ['leave.destroy', $leave->id], 'class' => 'm-0'])); ?>

                                                                <?php echo method_field('DELETE'); ?>
                                                                <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"
                                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                    data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="delete-form-<?php echo e($leave->id); ?>"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        <?php endif; ?>
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
    <script>
        $(document).on('change', '#employee_id', function() {
            var employee_id = $(this).val();
            $.ajax({
                url: '<?php echo e(route('leave.jsoncount')); ?>',
                type: 'POST',
                data: {
                    "employee_id": employee_id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    var oldval = $('#leave_type_id').val();
                    $('#leave_type_id').empty();
                    $('#leave_type_id').append(
                        '<option value=""><?php echo e(__('Select Leave Type')); ?></option>');

                    $.each(data, function(key, value) {
                        if (value.total_leave >= value.days) {
                            $('#leave_type_id').append('<option value="' + value.id +
                                '" disabled>' + value.title + '&nbsp(' + value.total_leave +
                                '/' + value.days + ')</option>');
                        } else {
                            $('#leave_type_id').append('<option value="' + value.id + '">' +
                                value.title + '&nbsp(' + value.total_leave + '/' + value
                                .days + ')</option>');
                            if (oldval) {
                                if (oldval == value.id) {
                                    $("#leave_type_id option[value=" + oldval + "]").attr(
                                        "selected", "selected");
                                }
                            }
                        }
                    });

                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\koristu\Modules/Hrm\Resources/views/leave/index.blade.php ENDPATH**/ ?>