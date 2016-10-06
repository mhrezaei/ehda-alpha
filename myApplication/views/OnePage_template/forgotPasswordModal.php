<?php if($key['time'] + (60 * 60) > time()){ ?>
<!-- change password by forgot modal start -->
<!-- Modal -->
<div class="modal fade" id="fPasswordModal" tabindex="-1" role="dialog" aria-labelledby="fPasswordModalLable">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="fPasswordModalLable" style="font-family: 'webYekan', Tahoma;">تغییر رمز عبور</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="fPasswordForm" id="fPasswordForm">

                    <div class="form-group">
                        <label for="txtfPassword" class="col-sm-3 control-label">رمز عبور جدید:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="txtfPassword" name="txtfPassword" maxlength="256" placeholder="حداقل 6 کاراکتر با حروف انگلیسی یا اعداد وارد نمائید.">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtfPasswordVerify" class="col-sm-3 control-label">تکرار رمز عبور:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="txtfPasswordVerify" name="txtfPasswordVerify" maxlength="256" placeholder="تکرار رمز عبور خود را وارد نمائید.">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php $fPasstQs = securityQuestion('y', NULL, FALSE, 'fPassQs'); ?>
                        <label for="txtfPassQa" class="col-sm-3 control-label" id="qaPassLabel">حاصل <?php echo $fPasstQs['value']; ?>؟</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtfPassQa" name="txtfPassQa" placeholder="حاصل عبارت روبرو را وارد نمائید">
                            <input type="hidden" value="<?php echo $fPasstQs['key']; ?>" class="form-control" name="txtfPassQaK" id="txtfPassQaK">
                            <input type="hidden" value="<?php echo $key['auth']; ?>" class="form-control" name="txtfPassAuth" id="txtfPassAuth">
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div role="alert" class="alert alert-dismissible fade in alertP" id="fPasswordAlert" style="display: none;">
                                <span id="fPasswordAlertMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                            </div>
                        </div>
                        <div class="col-sm-2" style="text-align: left; padding-top: 12px;"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="progress" style="display: none; margin-top: 15px;" id="fPassLoad">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span style="font-family: 'webYekan', Tahoma;">شکیبا باشید...</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="fPassBtn">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: 'webYekan', Tahoma;">انصراف</button>
                <button type="button" class="btn btn-primary" style="font-family: 'webYekan', Tahoma;" onclick="changePassByForgot();">تغییر رمز عبور</button>
            </div>
        </div>
    </div>
</div>
<!-- change password by forgot modal end -->

<?php }else{ ?>

    <!-- change password by forgot modal start -->
    <!-- Modal -->
    <div class="modal fade" id="fPasswordModal" tabindex="-1" role="dialog" aria-labelledby="fPasswordModalLable">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="fPasswordModalLable" style="font-family: 'webYekan', Tahoma;">تغییر رمز عبور</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div role="alert" class="alert alert-dismissible fade in alertP alert-warning" id="fPasswordAlert" style="display: block;">
                            <span id="fPasswordAlertMsg" style="line-height: 20px;">زمان استفاده از لینک بازآوری رمز عبور منقضی شده است. لطفاً دوباره فرم درخواست را تکمیل نمائید.</span>
                        </div>
                    </div>
                    <div class="col-sm-1" style="text-align: left; padding-top: 12px;"></div>
                    </div>
                </div>
                <div class="modal-footer" id="fPassBtn">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: 'webYekan', Tahoma;">انصراف</button>
                </div>
            </div>
        </div>
    </div>
    <!-- change password by forgot modal end -->

<?php } ?>

<script language="JavaScript">
    $(document).ready(function(){
        $('#fPasswordModal').modal({backdrop: 'static', keyboard: false, show: true});
        $('#fPasswordModal').on('hidden.bs.modal', function (e) {
            window.location = base_url();
        })
    });
</script>