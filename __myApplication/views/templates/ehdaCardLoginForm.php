<div class="modal fade" id="ehdaCardLoginModal" tabindex="-1" role="dialog" aria-labelledby="ehdaCardLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: left"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="userLoginHeader" style="font-family: 'webYekan';">ورود به سامانه کارت اهدای عضو</h4>
            </div>
            <div class="modal-body" style="font-family: 'BNazanin'; font-size: 18px; line-height: 28px; text-align: justify;" id="userLoginBody">
                <div class="form-horizontal">

                    <div class="form-group">
                        <div class="col-sm-1">
                            <label title="تکمیل الزامی" style="display: block; font-size: 12px; line-height: 30px;" class="glyphicon glyphicon-star"></label>
                        </div>
                        <div class="col-sm-9">
                            <input type="input" maxlength="" placeholder="نام کاربری / ایمیل" value="" style="direction: ltr; font-family: 'webYekan';" class="form-control" name="txtUserName" id="txtUserName">
                        </div>
                        <label for="txtUserName" style="text-align: right; font-size: 13px; color: #086E84; font-family: 'webYekan'; line-height: 18px; font-weight: normal;" class="col-sm-2 control-label">نام کاربری / ایمیل:</label>
                    </div>

                    <div style="display: none;" class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-9">
                        </div>
                        <div class="col-sm-2"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1">
                            <label title="تکمیل الزامی" style="display: block; font-size: 12px; line-height: 30px;" class="glyphicon glyphicon-star"></label>
                        </div>
                        <div class="col-sm-9">
                            <input type="password" maxlength="" placeholder="رمز عبور" value="" style="direction:ltr; font-family: 'webYekan';" class="form-control" name="txtPassWord" id="txtPassWord">
                        </div>
                        <label for="txtPassWord" style="text-align: right; font-size: 13px; color: #086E84; font-family: 'webYekan'; line-height: 18px; font-weight: normal;" class="col-sm-2 control-label">رمز عبور:</label>
                    </div>

                    <div style="display: none;" class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-9">
                        </div>
                        <div class="col-sm-2"></div>
                    </div>

                    <div class="form-group">
                        <?php $userLoginQs = securityQuestion('y', NULL, FALSE, 'userLoginQs'); ?>
                        <div class="col-sm-1">
                            <label title="تکمیل الزامی" style="display: block; font-size: 12px; line-height: 30px;" class="glyphicon glyphicon-star"></label>
                        </div>
                        <div class="col-sm-9">
                            <input type="input" maxlength="" placeholder="پاسخ سوال امنیتی" value="" style="direction:ltr; font-family: 'webYekan';" class="form-control " name="txtQs" id="txtQs">
                            <input type="hidden" value="<?php echo $userLoginQs['key']; ?>" class="form-control " name="txtQsK" id="txtQsK">
                        </div>
                        <label for="txtQs" style="text-align: right; font-size: 13px; color: #086E84; font-family: 'webYekan'; line-height: 18px; font-weight: normal;" class="col-sm-2 control-label">حاصل <?php echo $userLoginQs['value']; ?>؟</label>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="#" id="forgotPassBtn" style="font-size: 13px; font-weight: normal;" class="taha" >نام کاربری / رمز عبور خود را فراموش کرده اید؟</a>
                        </div>
                    </div>

                </div>

                <div style="width: 100%; height: 50px; text-align: center; margin: 0 auto; direction: rtl; font-family: 'webYekan'; color: #6D5712; display: none; font-size: 12px;" id="userLoginWMsg">شکیبا باشید...</div>

                <div class="alert alert-danger taha" style="font-size: 12px; text-align: center; padding: 2px; width: 70%; margin: 0 auto; display: none;" id="userLoginMsg" role="alert">نام کاربری / رمز عبور صحیح نمی باشد.</div>

            </div>
            <div class="modal-footer" style="text-align: left;" id="userLoginFooter">

                <a id="btnUserCardPrint" type="button" class="btn btn-success taha" target="_blank" style="display: none;" >چاپ کارت اهدای عضو</a>
                <a id="btnUserCardDownload" type="button" class="btn btn-info taha" target="_blank" style="display: none;" >دانلود کارت اهدای عضو</a>
                <button type="button" class="btn btn-success taha" id="ehdaUserLogin" onclick="userLogin();">ورود به سامانه</button>
                <button type="button" class="btn btn-default taha" data-dismiss="modal" id="userLoginModalClose">انصراف</button>

            </div>
        </div>
    </div>
</div>