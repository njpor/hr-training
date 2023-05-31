<?php $__env->startSection('content'); ?>
    <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col">
                <div class="big-icon">
                    <i class="icofont icofont-contact-add"></i>
                </div>
                <div class="d-inline-block">
                    <h5>Import Data</h5>
                    <span>เพิ่มข้อมูลการอบรมของพนักงาน</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10"></div>
        <button class="col-sm-2 btn  btn-light btn-round" type="button">
            <a href="<?php echo e(asset('local\storage\filefordownload\templete_import.xlsx')); ?>" download>
                <i class="icofont icofont-download-alt"></i>downlaoad templete
            </a>
        </button>
    </div>
    <div class="row">
        <div class="col-sm-10"></div>
        <div class="col-sm-2" style="font-size: 10px; color:red; text-align:right"><b>**กรุณาใช้เทมเพลตนี้</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
    </div>
    <br>

    <div class="card">
        <br>
        <div style="text-align: center">
            <span style=" font-size:13px"><b>ตัวอย่าง </b> หัวตารางของไฟล์ Excel Import </span>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table id="datatable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>EmployeeID</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Result</th>
                            <th>Date</th>
                            <th>Method / Place</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <form action="<?php echo e(route('importExcel')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><b>Choose File</b></label>
            <div class="col-sm-9">
                <input type="file" name="file" class="form-control form-control-round" accept=".xlsx, .xls">
            </div>
            <button class="col-sm-2 btn btn-round btn-primary" type="submit" >import</button>
        </div>
    </form>


    <?php if(Session::has('Error')): ?>
        <p class="alert <?php echo e(Session::get('alert-class', 'alert-danger')); ?>"><?php echo e(Session::get('Error')); ?></p>
    <?php endif; ?>
    <?php if(Session::has('Error2')): ?>
        <p class="alert <?php echo e(Session::get('alert-class', 'alert-warning')); ?>"><?php echo e(Session::get('Error2')); ?></p>
    <?php endif; ?>
    <?php if(Session::has('Success')): ?>
        <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>"><?php echo e(Session::get('Success')); ?></p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_bottom'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\a\local\resources\views/import/index.blade.php ENDPATH**/ ?>