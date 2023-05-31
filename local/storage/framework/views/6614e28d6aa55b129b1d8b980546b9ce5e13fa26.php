<?php if(Session::get('idpuser')->Type == 'ADMIN'): ?>
    <nav class="pcoded-navbar">
        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="icon-close icons"></i></a></div>
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">User</div>
            <ul class="pcoded-item pcoded-left-item">

                <li class="pcoded pcoded-trigger" dropdown-icon="" subitem-icon="">
                    <a href="<?php echo e(asset('/dashboard')); ?>">
                        <span class="pcoded-micon"><i class="ti-bookmark-alt"></i><b>P</b></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
            </ul>

            <div class="pcoded-navigation-label">Admin</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded pcoded-trigger">
                    <a href="<?php echo e(asset('/import')); ?>">
                        <span class="pcoded-micon"><i class="icofont icofont-upload-alt"></i><b>D</b></span>
                        <span class="pcoded-mtext">Import Data</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="pcoded pcoded-trigger" dropdown-icon="" subitem-icon="">
                    <a href="<?php echo e(asset('/updateResult')); ?>">
                        <span class="pcoded-micon"><i class="icofont icofont-upload-alt"></i><b>D</b></span>
                        <span class="pcoded-mtext">Update Results</span>
                    </a>
                </li>
                <li class="pcoded pcoded-trigger" dropdown-icon="" subitem-icon="">
                    <a href="<?php echo e(asset('/listidp')); ?>">
                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>D</b></span>
                        <span class="pcoded-mtext">List Employee</span>
                    </a>
                </li>
                <li class="pcoded pcoded-trigger" dropdown-icon="" subitem-icon="">
                    <a href="<?php echo e(asset('/course')); ?>">
                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>D</b></span>
                        <span class="pcoded-mtext">List Course</span>
                    </a>
                </li>
                <li class="pcoded pcoded-trigger" dropdown-icon="" subitem-icon="">
                    <a href="<?php echo e(asset('/courseDetails')); ?>">
                        <span class="pcoded-micon"><i class="icofont icofont-edit"></i><b>D</b></span>
                        <span class="pcoded-mtext">กำหนด Target and Details</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\a\local\resources\views/partials/_body_left_sidebar.blade.php ENDPATH**/ ?>