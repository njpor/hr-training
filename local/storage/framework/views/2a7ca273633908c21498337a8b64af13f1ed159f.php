<?php $__env->startSection('content'); ?>

    <a href="<?php echo e(asset('/course')); ?>">
        <button class="btn btn-secondary" style="font-size: 12px;">
            < ย้อนกลับ</button>
    </a><br><br>

    <div class="card">
        <div class="card-block">

            <form id="delete_idp_select" method="post" autocomplete="off" class="was-validated">
                <?php echo e(csrf_field()); ?>

                <div class="table-responsive">
                    <br>
                    <span style="text-align: center">
                        <h5>Coures การอบรม</h5>
                    </span><br><br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">CategoryName</th>
                                <th width="40%">CourseName</th>
                                <th width="15%">Date</th>
                                <th width="30%">Method</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <tr>
                                <td width="25%" class="numberRow_under" style="text-align: center;">
                                    <input type="hidden" class="form-control" name="category_id"
                                        value="<?php echo e($course_select->CategoryID); ?>">
                                    <input type="text" class="form-control" value="<?php echo e($course_select->CategoryName); ?>"
                                        name="category_name" readonly>
                                </td>
                                <td width="35%">
                                    <input type="hidden" class="form-control" name="course_id"
                                        value="<?php echo e($course_select->CourseID); ?>">
                                    <input type="text" class="form-control" value="<?php echo e($course_select->CourseName); ?>"
                                        name="course_name" readonly>
                                </td>
                                <td width="15%">
                                    <input type="text" class="form-control" value="<?php echo e($course_select->Date); ?>"
                                        name="course_date" readonly>
                                </td>
                                <td width="25%">
                                    <input type="hidden" class="form-control" name="method_id"
                                        value="<?php echo e($course_select->MethodID); ?>">
                                    <input type="text" class="form-control" value="<?php echo e($course_select->MethodName); ?>"
                                        name="method_name" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br>

                <div class="row">
                    <div class="col-lg-10 col-md-12">
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">Delete</button>
                        </div>
                    </div>
                </div>

            </form>
            <br><br><br>

            <div class="table-responsive">
                <span style="text-align: center">
                    <h5>รายชื่อพนักงานที่มี Coures การอบรมนี้</h5>
                </span><br><br>
                <table id="simpletable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">No</th>
                            <th width="10%" style="text-align: center">id</th>
                            <th width="20%" style="text-align: center">Name</th>
                            <th width="30%" style="text-align: center">Email</th>
                            <th width="15%" style="text-align: center">Position</th>
                            <th width="15%" style="text-align: center">Section</th>
                            <th width="15%" style="text-align: center">Division</th>
                            <th width="15%" style="text-align: center">Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                        ?>
                        <?php $__currentLoopData = $list_emp_select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="font-size:13px; text-align: center"><?php echo e($no++); ?> </td>
                                <td style="font-size:13px;"><?php echo e($item->EmployeeID); ?> </td>
                                <td style="font-size:13px;"><?php echo e($item->TFName); ?> <?php echo e($item->TLName); ?></td>
                                <td style="font-size:13px;"><?php echo e($item->Email == null ? '-' : $item->Email); ?> </td>
                                <td style="font-size:13px;"><?php echo e($item->Position == null ? '-' : $item->Position); ?> </td>
                                <td style="font-size:13px;"><?php echo e($item->Section == null ? '-' : $item->Section); ?> </td>
                                <td style="font-size:13px;"><?php echo e($item->Division == null ? '-' : $item->Division); ?> </td>
                                <td style="font-size:13px;"><?php echo e($item->Department == null ? '-' : $item->Department); ?></td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_bottom'); ?>
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('table.display').DataTable({
                "searching": true,
                "ordering": true
            });
            // $('.dataTables_filter').css("display", "none");
            // $('.dataTables_length').css("display", "none");
            // $('.dataTables_info').css("display", "none");
            // $('.dataTables_paginate').css("display", "none");
        });

        var category_id = <?php echo e($course_select->CategoryID); ?>

        var course_id = <?php echo e($course_select->CourseID); ?>

        var method_id = <?php echo e($course_select->MethodID); ?>


        //action click submit
        $("#delete_idp_select").submit(function(e) {
            e.preventDefault();
            var forms = $('#delete_idp_select')[0];
            var data = new FormData(forms);
            var textalert = '';
            textalert = {
                title: 'ลบรายการ',
                text: "คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "ตกลง",
                cancelButtonText: 'ยกเลิก'
            };
            Swal.fire(
                textalert
            ).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo e(url('/delete')); ?>",
                        type: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: data,
                        icon: 'success',
                        success: function(data) {
                            if (data.code == 400) {
                                error();
                            } else {
                                success_del();
                            }
                            setTimeout(function() {
                                //location.reload();
                                location.href = "<?php echo e(asset('/course')); ?>";
                            }, 1500);
                        }
                    })
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\a\local\resources\views/course/details.blade.php ENDPATH**/ ?>