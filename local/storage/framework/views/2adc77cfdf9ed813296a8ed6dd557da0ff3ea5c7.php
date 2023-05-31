<?php echo $__env->make('partials._body_style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="login p-fixed d-flex text-center bg-light " style="background: linear-gradient( 45deg,  #b8f2e6, #9cdce6, #acbeea);">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <!-- Authentication card start -->
                <div class="signin-card card-block auth-body mr-auto ml-auto">
                    <input type="hidden" id="chkuserpermissions" name="chkuserpermissions"
                        value="<?php echo e(Session::get('chkuserpermissions')); ?>">
                    <input type="hidden" id="chkconnectionerror" name="chkconnectionerror"
                        value="<?php echo e(Session::get('chkconnectionerror')); ?>">

                    <form action="<?php echo e(url('getOAuthcode')); ?>" method="post" class="was-validated">
                        <?php echo e(csrf_field()); ?>

                        <div class="auth-box">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <img class="img-fluid" width="300" src="<?php echo e(asset('files/assets/images/3.jpg')); ?>" alt="Theme-Logo" />
                                    <h3 class="text-center txt-primary">Login</h3>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="email" name="email">
                                <span class="md-line"></span>
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="password" name="password">
                                <span class="md-line"></span>
                            </div>

                            

                            
                            <br>
                            <button type="submit"
                                class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<?php /**PATH C:\xampp\htdocs\a\local\resources\views/authentication/loginadmin.blade.php ENDPATH**/ ?>