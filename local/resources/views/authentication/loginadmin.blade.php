@include('partials._body_style')
<section class="login p-fixed d-flex text-center bg-light " style="background: linear-gradient( 45deg,  #b8f2e6, #9cdce6, #acbeea);">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <!-- Authentication card start -->
                <div class="signin-card card-block auth-body mr-auto ml-auto">
                    <input type="hidden" id="chkuserpermissions" name="chkuserpermissions"
                        value="{{ Session::get('chkuserpermissions') }}">
                    <input type="hidden" id="chkconnectionerror" name="chkconnectionerror"
                        value="{{ Session::get('chkconnectionerror') }}">

                    <form action="{{ url('getOAuthcode') }}" method="post" class="was-validated">
                        {{ csrf_field() }}
                        <div class="auth-box">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <img class="img-fluid" width="300" src="{{ asset('files/assets/images/3.jpg') }}" alt="Theme-Logo" />
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

                            {{-- <div class="input-group">
                                <input type="text" class="form-control" placeholder="empid" name="textuser" >
                                <span class="md-line"></span>
                            </div> --}}

                            {{--  <select style="" class="form-select" name="textuser"
                                    aria-label="Default select example" required>
                                    <option value="1890">1890 Admin</option>
                                    <option value="1885">1885 emp</option>
                                    <option value="1022">1022 emp</option>
                                </select> --}}
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
