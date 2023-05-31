@include('partials._body_style')
<section class="login p-fixed d-flex text-center  dt-responsive"
    style="background: linear-gradient( 90deg,  #b8f2e6, #aed9e0, #b3c1e3);">

    <div class="container-fluid">
        <div class="card">
            <div class="card-block" >
                <div class="row">
                    <div class="col-sm-12">
                        <img class="img-fluid" width="300" src="{{ asset('files/assets/images/3.jpg') }}" alt="Theme-Logo" />
                        <div class="signin-card card-block auth-body mr-auto ml-auto mt-auto mb-auto">
                            <a
                                href="https://api.jasmine.com/authen1/oauth/authorize?response_type=code&client_id=hYjxbHmFUK_Train&redirect_uri=https://hrjasgroup.triplet.co.th/callback/training">
                                <center> <button type="button" style="font-size: 15px;  padding: 1.0rem 4.5rem; display:block;"
                                        class="btn btn-primary  waves-effect waves-light ">เข้าระบบผ่าน Oauth</button>
                                </center>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>
