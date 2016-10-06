<div class="container">
    <div class="panel panel-default" style="margin-top: 5em;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">ورود</h3>
        </div>
        <div class="panel-body" style="font-family: 'BNazanin', Tahoma; font-size: 16px;">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- login form -->
                    <div class="col-md-12" id="loginForm" style="display: block; margin-bottom: 50px;">
                        <div class="ehdaCardP">
                            <form class="form-horizontal" name="loginFormSafir" method="post">
                                <div class="form-group">
                                    <label for="txtSafirLoginUsername" class="col-sm-2 control-label">نام کاربری:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtSafirLoginUsername" name="txtSafirLoginUsername" placeholder="نام کاربری را وارد نمائید.">
                                        <span class="glyphicon glyphicon-user form-control-feedback colorSur" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtSafirLoginPassword" class="col-sm-2 control-label">رمز عبور:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="txtSafirLoginPassword" name="txtSafirLoginPassword" placeholder="رمز عبور را وارد نمائید.">
                                        <span class="glyphicon glyphicon-lock form-control-feedback colorSur" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php $userLoginQs = securityQuestion('y', NULL, FALSE, 'esLoginQs'); ?>
                                    <label for="txtSafirLoginQa" class="col-sm-2 control-label" id="qaLabel">حاصل <?php echo $userLoginQs['value']; ?>؟</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtSafirLoginQa" name="txtSafirLoginQa" placeholder="حاصل عبارت روبرو را وارد نمائید">
                                        <span class="glyphicon glyphicon-lock form-control-feedback colorSur" aria-hidden="true"></span>
                                        <input type="hidden" value="<?php echo $userLoginQs['key']; ?>" class="form-control" name="txtSafirLoginQsK" id="txtSafirLoginQsK">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <?php if(isset($msg)){ ?>
                                        <div role="alert" class="alert alert-warning alert-dismissible fade in alertP" style="display: block;">
                                            <?php if(isset($msg) AND $msg == 1){ ?>
                                                <span style="line-height: 20px;">پاسخ سوال امنیتی صحیح نمی باشد.</span>
                                            <?php }elseif(isset($msg) AND $msg == 2){ ?>
                                                <span style="line-height: 20px;">نام کاربری یا رمز عبور صحیح نمی باشد.</span>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-4" style="text-align: left; padding-top: 12px;" id="loginBtns">
                                        <button type="button" class="btn btn-warning" onclick="changeUrl('');" style="float: left;">انصراف</button>
                                        <button type="submit" class="btn btn-info" style="float: left; margin-left: 10px;">ورود</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- login form -->
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>