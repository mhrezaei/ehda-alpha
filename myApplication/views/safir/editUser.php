<script src="<?php echo asset_url(); ?>js/safir/custom.js"></script>
<div class="container">
    <div class="panel panel-default" style="margin-top: 5em;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">ثبت نام کارت اهدای عضو</h3>
        </div>
        <div class="panel-body">
            <?php if($success == 'ok'){ ?>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div role="alert" class="alert alert-dismissible alert-success" style="margin-bottom: 10px;">
                            <span style="line-height: 20px; font-family: 'webYekan', Tahoma;">اطلاعات با موفقیت ثبت شد.</span>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php }else if($success == 'delete'){ ?>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div role="alert" class="alert alert-dismissible alert-success" style="margin-bottom: 10px;">
                            <span style="line-height: 20px; font-family: 'webYekan', Tahoma;">کارت مورد نظر با موفقیت حذف شد.</span>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php } ?>
            <?php if($user == 'Err'){ ?>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div role="alert" class="alert alert-dismissible alert-warning" style="margin-bottom: 10px;">
                            <span style="line-height: 20px; font-family: 'webYekan', Tahoma;">کدملی یافت نشد.</span>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php } ?>
            <form class="form-horizontal" method="get">
                <div class="form-group">
                    <label for="txtnationalcode" class="col-sm-2 control-label">کدملی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtnationalcode" name="txtnationalcode" placeholder="کدملی 10 رقمی" value="<?php echo $this->input->get('txtnationalcode', true); ?>">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-info" style="float: left; margin-left: 10px; font-family: 'webYekan', Tahoma;">جستجو</button>
                </div>
            </form>
            <?php if (is_array($user)){ ?>
            <form class="form-horizontal" name="registerForm" id="registerForm" method="post">

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات فردی</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterFirstName" class="col-sm-2 control-label">نام:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterFirstName" name="txtRegisterFirstName" placeholder="نام را با حروف فارسی وارد نمائید." value="<?php echo $user['data']['firstName']; ?>">
                        <input type="hidden" class="form-control" id="txtRegisterNationalcode" name="txtRegisterNationalcode" value="<?php echo $user['nationalcode']; ?>">
                        <input type="hidden" class="form-control" id="txtRegisterID" name="txtRegisterID" value="<?php echo $user['id']; ?>">
                        <input type="hidden" class="form-control" id="txtPrint" name="txtPrint">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterLastName" class="col-sm-2 control-label">نام خانوادگی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterLastName" name="txtRegisterLastName" placeholder="نام خانوادگی را با حروف فارسی وارد نمائید." value="<?php echo $user['data']['lastName']; ?>">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cbRegisterGender" class="col-sm-2 control-label">جنسیت:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="cbRegisterGender" name="cbRegisterGender">
                            <option value="0">انتخاب کنید...</option>
                            <option value="2" <?php if($user['data']['sex'] == 2){echo 'selected="selected"';} ?>>خانم</option>
                            <option value="1" <?php if($user['data']['sex'] == 1){echo 'selected="selected"';} ?>>آقا</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterFatherName" class="col-sm-2 control-label">نام پدر:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterFatherName" name="txtRegisterFatherName" placeholder="نام پدر را با حروف فارسی وارد نمائید" value="<?php echo $user['data']['fatherName']; ?>">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterIDNumber" class="col-sm-2 control-label">شماره شناسنامه:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterIDNumber" name="txtRegisterIDNumber" placeholder="شماره شناسنامه  را به صورت عددی وارد نمائید" value="<?php echo $user['data']['identifier']; ?>">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group" id="mhrDateTable">
                    <label for="cbRegisterBirthDate" class="col-sm-2 control-label">تاریخ تولد:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="cbRegisterBirthDate" name="cbRegisterBirthDate" placeholder="ترجیاً از جدول درج خودکار یا با فرمت 1350/9/25 وارد نمائید" value="<?php echo pdate('Y/m/d', $user['data']['dateOfBirth']); ?>">
                        <input type="hidden" id="txtExtraBirthday" name="txtExtraBirthday" value="<?php echo date('Y/m/d', $user['data']['dateOfBirth']); ?>">
                        <script>
                            var date1 = new MHR.persianCalendar('cbRegisterBirthDate',
                                {
                                    extraInputID: "txtExtraBirthday", extraInputFormat: "YYYY/MM/DD" });
                        </script>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterPlaceOfBirth" class="col-sm-2 control-label">محل تولد:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterPlaceOfBirth" name="txtRegisterPlaceOfBirth" placeholder="محل تولد  را با حروف فارسی وارد نمائید" value="<?php echo $user['data']['placeOfBirth']; ?>">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات تماس</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterMobile" class="col-sm-2 control-label">تلفن همراه:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterMobile" name="txtRegisterMobile" maxlength="11" placeholder="تلفن همراه  را 11 رقمی و بدون خط تیره وارد نمائید" value="<?php echo $user['data']['mobile']; ?>">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterTel" class="col-sm-2 control-label">تلفن ثابت:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterTel" name="txtRegisterTel" maxlength="11" placeholder="تلفن ثابت را 11 رقمی همراه با پیش شماره وارد نمائید" value="<?php echo $user['data']['phone']; ?>">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cbRegisterState" class="col-sm-2 control-label">استان:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="cbRegisterState" name="cbRegisterState" onchange="selectCity();">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                    <script language="JavaScript">
                        $(document).ready(function(){
                            $("#cbRegisterState").val(<?php echo $user['data']['state']; ?>);
                            selectEditCity(<?php echo $user['data']['city']; ?>);
                        });
                    </script>
                </div>

                <div class="form-group">
                    <label for="cbRegisterCity" class="col-sm-2 control-label">شهر:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="cbRegisterCity" name="cbRegisterCity">
                            <option value="0">انتخاب کنید...</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                    <script language="JavaScript">
                        $(document).ready(function(){
                            //$("#cbRegisterCity").val(135);
                        });
                    </script>
                </div>

                <div class="form-group" style="font-family: 'webYekan', Tahoma;">
                    <input type="checkbox" name="changePasswordFromMobile" id="changePasswordFromMobile" style="float: right;" value="<?php echo $user['data']['mobile']; ?>">
                    <label for="changePasswordFromMobile" style="float: right; padding-right: 10px;"> قرار دادن شماره موبایل به عنوان رمز عبور برای این کاربر</label>
                </div>

                <div class="row" style="margin-left: 20px; font-family: 'webYekan', Tahoma;">
                        <button type="button" class="btn btn-warning" style="float: left;" onclick="changeUrl('safir/editOneUser');">انصراف</button>
                        <button type="button" class="btn btn-info" onclick="submitEditFormSafir(1);" style="float: left; margin-left: 10px;">ارسال اطلاعات و چاپ</button>
                        <button type="button" class="btn btn-primary" onclick="submitEditFormSafir(2);" style="float: left; margin-left: 10px;">ارسال اطلاعات</button>
                        <button type="button" class="btn btn-danger" onclick="submitEditFormSafir(3);" style="float: left; margin-left: 10px;">حذف کارت</button>
                </div>
            </form>
            <?php } ?>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div role="alert" class="alert alert-dismissible fade in alertP" id="warningAlert" style="display: none;">
<!--                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>-->
                            <span id="registerFormMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                        </div>
                    </div>
                    <div class="col-sm-4" style="text-align: left; padding-top: 12px;">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="progress" style="display: none; margin-top: 15px;">
                            <div class="progress-bar progress-bar-success progress-bar-striped active" id="progressVal" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <span style="font-family: 'webYekan', Tahoma;">شکیبا باشید...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>