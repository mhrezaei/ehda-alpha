<?php if($this->users_model->is_user()){ ?>
<!--    change user password modal-->
    <!-- Modal -->
    <div class="modal fade" id="userChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="userChangePasswordModalLable">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-family: 'webYekan', Tahoma;">تغییر رمز عبور</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="txtOldUserPassword" class="col-sm-3 control-label">رمز عبور قبلی:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="txtOldUserPassword" name="txtOldUserPassword" maxlength="256" placeholder="رمز عبور قبلی خود را وارد نمائید.">
                            </div>
                            <div class="col-sm-1">
                                <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtNewUserPassword" class="col-sm-3 control-label">رمز عبور جدید:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="txtNewUserPassword" name="txtNewUserPassword" maxlength="256" placeholder="حداقل 6 کاراکتر، حروف انگلیسی یا عدد">
                            </div>
                            <div class="col-sm-1">
                                <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtNewUserPasswordVerify" class="col-sm-3 control-label">تکرار رمز عبور:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="txtNewUserPasswordVerify" name="txtNewUserPasswordVerify" maxlength="256" placeholder="تکرار رمز عبور جدید">
                            </div>
                            <div class="col-sm-1">
                                <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div role="alert" class="alert alert-dismissible fade in alertP" id="userPasswordAlert" style="display: none;">
                                    <span id="userPasswordAlertMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                                </div>
                            </div>
                            <div class="col-sm-2" style="text-align: left; padding-top: 12px;"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="progress" style="display: none; margin-top: 15px;" id="changePassLoad">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" id="progressVal" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        <span style="font-family: 'webYekan', Tahoma;">شکیبا باشید...</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="changePassBtn">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: 'webYekan', Tahoma;">انصراف</button>
                    <button type="button" class="btn btn-primary" style="font-family: 'webYekan', Tahoma;" onclick="changeUserPassword();">ذخیره رمز عبور</button>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>


<!-- forgot password modal start -->
<!-- Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLable">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="forgotPasswordModalLable" style="font-family: 'webYekan', Tahoma;">بازیابی رمز عبور</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="forgotPasswordForm" id="forgotPasswordForm">
                    <div class="form-group" style="font-family: 'BNazanin', Tahoma; font-size: 15px; text-align: justify;">
                        در صورتی که رمز عبور خود را برای ورود به سامانه فراموش کرده اید و نام کاربری یا ایمیل خود را می دانید از طریق فرم زیر اقدام به بازیابی رمز عبور خود نمائید.
                        <br>
                        در غیر این صورت اطلاعات خواسته شده زیر را به آدرس ایمیل card@ehda.center ارسال نمائید تا پس از بررسی اطلاعات ورود برای شما ارسال شود.
                        <br>
                        <br>
                        <ul style="list-style: disc; padding-right: 25px; font-family: 'webYekan', Tahoma; font-size: 12px; color: #265A88;">
                            <li>نام و نام خانوادگی</li>
                            <li>کدملی</li>
                            <li>شماره شناسنامه</li>
                            <li>تلفن همراه</li>
                            <li>آدرس ایمیل</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="txtForgotNationalCode" class="col-sm-3 control-label">کدملی:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtForgotNationalCode" name="txtForgotNationalCode" maxlength="10" placeholder="کدملی 10 رقمی خود را بدون خط تیره وارد نمائید.">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtForgotUsername" class="col-sm-3 control-label">نام کاربری:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtForgotUsername" name="txtForgotUsername" maxlength="256" placeholder="نام کاربری خود را وارد نمائید.">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtForgotEmail" class="col-sm-3 control-label">ایمیل:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="txtForgotEmail" name="txtForgotEmail" maxlength="256" placeholder="ایمیل خود را وارد نمائید.">
                            <div style="color: #265A88; padding-top: 5px; padding-right: 5px; font-size: 11px;">تکمیل یکی از گزینه های نام کاربری یا ایمیل اجباری می باشد.</div>
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php $forgotQs = securityQuestion('y', NULL, FALSE, 'forgotPassQs'); ?>
                        <label for="txtForgotQa" class="col-sm-3 control-label" id="qaForgotLabel">حاصل <?php echo $forgotQs['value']; ?>؟</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtForgotQa" name="txtForgotQa" placeholder="حاصل عبارت روبرو را وارد نمائید">
                            <input type="hidden" value="<?php echo $forgotQs['key']; ?>" class="form-control" name="txtForgotQaK" id="txtForgotQaK">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div role="alert" class="alert alert-dismissible fade in alertP" id="forgotPasswordAlert" style="display: none;">
                                <span id="forgotPasswordAlertMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                            </div>
                        </div>
                        <div class="col-sm-2" style="text-align: left; padding-top: 12px;"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="progress" style="display: none; margin-top: 15px;" id="forgotPassLoad">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" id="progressVal" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span style="font-family: 'webYekan', Tahoma;">شکیبا باشید...</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="forgotPassBtn">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: 'webYekan', Tahoma;">انصراف</button>
                <button type="button" class="btn btn-primary" style="font-family: 'webYekan', Tahoma;" onclick="forgotPassword();">بازیابی رمز عبور</button>
            </div>
        </div>
    </div>
</div>
<!-- forgot password modal end -->

<?php } ?>

</body>
</html>