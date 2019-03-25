<div class="modal fade common-model" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="padding:0px">
            <div id="signup-header" class="modal-header text-center">
                <a href="/"><img src="/front/img/logo.png" alt="logo" title=""></a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <h4 class="text-center" id="password_title">Forgot Password</h4>
            <p class="text-center para pt-3">Enter your email address below and we will send you the link to change your password</p>
            <div class="modal-body-signup" id="cont">
                <div class="row">
                    <div class="col-12">
                        <div class = 'row'>
                            <div class = 'col-12'>
                                <label for="email" class="required" style="font-family: Futura-Bold;font-weight: 700;font-size: 12px;line-height: 18px;">Email</label>
                                <input id="email"type="email" class="form-control required" value="" style="border:1px solid #000">
                            </div>
                        </div>

                        <div class = 'row'>
                            <div class = 'col-12 text-danger' id = 'reset-message'>
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class = 'col-12'>
                                <button type="submit" id="reset" class="btn yellow-submit">SEND RESET REQUEST</button>
                            </div>
                        </div>

                        <div class = 'row'>
                            <div class = 'col-12'>
                                <p class="text-center" style="font-family: AvenirLTStd-Roman;font-size:12px;color:#000;line-height:16px;margin-top:50px">
                                    <a href="#" id="log"  data-toggle="modal" data-target="#largeModalSI" style="font-family: AvenirLTStd-Roman;font-size:12px;color:#4444ce;line-height:16px">
                                        LOGIN
                                    </a> or
                                    <a href="#" id="sign" data-toggle="modal" data-target="#largeModalS" style="font-family: AvenirLTStd-Roman;font-size:12px;color:#4444ce;line-height:16px">
                                        SIGN UP
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>