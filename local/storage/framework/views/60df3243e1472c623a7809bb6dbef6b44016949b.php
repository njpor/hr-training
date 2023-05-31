<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <?php if(Session::get('idpuser')->Type == 'ADMIN'): ?>
                    <i class="ti-menu"></i>
                <?php endif; ?>
            </a>
            <!-- รูป logo header -->
            <a href="<?php echo e(asset('/dashboard')); ?>">
                <img class="img-fluid" height="80" width="180" src="<?php echo e(asset('files/assets/images/logo6.png')); ?>"
                    alt="Theme-Logo" />
            </a>
            <a class="mobile-options">
                <i class=""></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <?php if(Session::get('idpuser')->Type == 'ADMIN'): ?>
                    <li>
                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="nav-right">
                <li>
                    <a href="#" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
                <li class="user-profile header-notification">
                    <a href="#">
                        <img src="<?php echo e(asset('files/assets/images/por/yo.gif')); ?>" class="img-radius"
                            alt="User-Profile-Image">
                        <span><?php echo e(Session::get('idpuser')->EmployeeID); ?> | <?php echo e(Session::get('idpuser')->TFName); ?>

                            <?php echo e(Session::get('idpuser')->TLName); ?></span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        <li>
                            <a href="<?php echo e(url('#')); ?>" data-toggle="modal" data-target="#reset-password">
                                <i class="icofont icofont-edit"></i> เปลี่ยนรหัสผ่าน
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('logoutCookie')); ?>">
                                <i class="icofont icofont-logout"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="reset-password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="login-card card-block login-card-modal">
            <form action="<?php echo e(url('resetPassword')); ?>" method="post" class="md-float-material was-validated">
                <?php echo csrf_field(); ?>
                <div class="auth-box">
                    <div class="row m-b-0">
                        <div class="col-md-12" style="text-align: center">
                            <img class="img-fluid" width="150" src="<?php echo e(asset('files/assets/images/por/desk.gif')); ?>"
                                alt="Theme-Logo" />
                            <h3 class="text-left">Change your Password</h3>
                        </div>
                    </div>
                    <p class="text-inverse b-b-default text-right"> </p>
                    <input type="hidden" class="form-control" name="empid"
                        value="<?php echo e(Session::get('idpuser')->EmployeeID); ?>">

                    <label>password :
                        <input name="newpassword" class="form-control" id="password" type="password"
                            placeholder="New Password" onkeyup='check();' />
                    </label>
                    <br>
                    <label>confirm password:
                        <input type="password" class="form-control" name="confirm" id="confirm_password"
                            placeholder="Confirm Password" onkeyup='check();' />
                        <span id='message'></span>
                    </label>

                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit"
                                class="btn btn-primary btn-md btn-block waves-effect text-center" id="por">Change
                                Password</button>
                        </div>
                    </div>
                    <hr />
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var check = function() {
        var p1 = document.getElementById('password').value;
        var p2 = document.getElementById('confirm_password').value;
        if (p1 == p2){
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        }else{
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Minimum password 6 characters';
        }
    }
</script>

<?php /**PATH C:\xampp\htdocs\a\local\resources\views/partials/_app_header.blade.php ENDPATH**/ ?>