<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-block">

            <br><h5 style="text-align: center">รายละเอียดหลักสูตรภายในระบบ</h5><br><br>

            <div class="table-responsive">
                <table id="simpletable" class="table ">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center;">No</th>
                            <th width="30%" style="text-align: center;">CourseName</th>
                            <th width="40%" style="text-align: center;">Detail</th>
                            <th width="20%" style="text-align: center;">Target</th>
                            <th width="5%" style="text-align: center;">#</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        <?php
                            $i=1;
                        ?>
                        <?php $__currentLoopData = $course_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $id = base64_encode($item->id);
                        ?>
                            <tr>
                                <td><?php echo e($i++); ?></td>
                                <td style="font-size:13px;" ><?php echo e($item->CourseName); ?></td>
                                <td style="font-size:12px">
                                    <?php if($item->Details == null): ?>
                                        <textarea style="max-width: 90%;" class="form-control" rows="1" cols="50" readonly>-</textarea>
                                    <?php else: ?>
                                        <textarea style="max-width: 90%;" class="form-control" rows="5" cols="50" readonly><?php echo e($item->Details); ?></textarea>
                                    <?php endif; ?>
                                </td>
                                <td><input style="max-width: 90%;" class="form-control" value="<?php echo e($item->Target == null ? '-' : $item->Target); ?>" readonly></td>
                                <td>
                                    <a href="<?php echo e(asset('/edit')); ?>/<?php echo e($id); ?>" style="font-size:13px;  color:rgba(217, 122, 33, 0.799);">
                                        <b>Edit</b>
                                        <i class="icofont icofont-rounded-double-right"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_bottom'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\a\local\resources\views/coursedetails/index.blade.php ENDPATH**/ ?>