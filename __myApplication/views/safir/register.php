<script src="<?php echo asset_url(); ?>js/safir/custom.js"></script>
<div class="container">
    <div class="panel panel-default" style="margin-top: 5em;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">ثبت نام کارت اهدای عضو</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" name="registerForm" id="registerForm">

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات فردی</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterFirstName" class="col-sm-2 control-label">نام:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterFirstName" name="txtRegisterFirstName" placeholder="نام را با حروف فارسی وارد نمائید.">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterLastName" class="col-sm-2 control-label">نام خانوادگی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterLastName" name="txtRegisterLastName" placeholder="نام خانوادگی را با حروف فارسی وارد نمائید.">
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
                            <option value="2">خانم</option>
                            <option value="1">آقا</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterFatherName" class="col-sm-2 control-label">نام پدر:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterFatherName" name="txtRegisterFatherName" placeholder="نام پدر را با حروف فارسی وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterIDNumber" class="col-sm-2 control-label">شماره شناسنامه:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterIDNumber" name="txtRegisterIDNumber" placeholder="شماره شناسنامه  را به صورت عددی وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterNationalCode" class="col-sm-2 control-label">کدملی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterNationalCode" name="txtRegisterNationalCode" maxlength="10" placeholder="کدملی را ده رقمی و بدون خط تیره وارد نمائید.">
                        <input type="hidden" name="txtDbCheck" id="txtDbCheck" value="0">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group" id="mhrDateTable">
                    <label for="cbRegisterBirthDate" class="col-sm-2 control-label">تاریخ تولد:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="cbRegisterBirthDate" name="cbRegisterBirthDate" placeholder="ترجیاً از جدول درج خودکار یا با فرمت 1350/9/25 وارد نمائید">
                        <input type="hidden" id="txtExtraBirthday" name="txtExtraBirthday">
                        <script>
                            var date1 = new MHR.persianCalendar('cbRegisterBirthDate',
                                { extraInputID: "txtExtraBirthday", extraInputFormat: "YYYY/MM/DD" });
                        </script>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterPlaceOfBirth" class="col-sm-2 control-label">محل تولد:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterPlaceOfBirth" name="txtRegisterPlaceOfBirth" placeholder="محل تولد  را با حروف فارسی وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>
<?php /* form
                <div class="form-group">
                    <label for="cbRegisterEducation" class="col-sm-2 control-label">میزان تحصیلات:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="cbRegisterEducation" name="cbRegisterEducation">
                            <option value="0">انتخاب کنید...</option>
                            <option value="1">زیر دیپلم</option>
                            <option value="2">دیپلم</option>
                            <option value="3">کاردانی</option>
                            <option value="4">کارشناسی</option>
                            <option value="5">کارشناسی‌ارشد</option>
                            <option value="6">دکترا و بالاتر</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterJob" class="col-sm-2 control-label">شغل:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterJob" name="txtRegisterJob" placeholder="در صورت تکمیل نمودن با حروف فارسی وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                    </div>
                </div>
*/ ?>
                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات تماس</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterMobile" class="col-sm-2 control-label">تلفن همراه:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterMobile" name="txtRegisterMobile" maxlength="11" placeholder="تلفن همراه  را 11 رقمی و بدون خط تیره وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterTel" class="col-sm-2 control-label">تلفن ثابت:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterTel" name="txtRegisterTel" maxlength="11" placeholder="تلفن ثابت را 11 رقمی همراه با پیش شماره وارد نمائید">
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
                            $("#cbRegisterState").val(8);
                            selectCity();
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
                            $("#cbRegisterCity").val(135);
                        });
                    </script>
                </div>
<?php /* form
                <div class="form-group">
                    <label for="txtRegisterEmail" class="col-sm-2 control-label">ایمیل:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="txtRegisterEmail" name="txtRegisterEmail" maxlength="256" placeholder="ایمیل خود را بدون www وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات ورود به سامانه</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterUsername" class="col-sm-2 control-label">نام کاربری:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterUsername" name="txtRegisterUsername" maxlength="256" placeholder="نام کاربری را با حروف انگلیسی یا عدد و حداقل 6 کاراکتر بدون فاصله وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterPassword" class="col-sm-2 control-label">رمز عبور:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="txtRegisterPassword" name="txtRegisterPassword" maxlength="256" placeholder="رمز عبور را با حروف انگلیسی یا عدد و حداقل 6 کاراکتر بدون فاصله وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterVerifyPassword" class="col-sm-2 control-label">تکرار رمز عبور:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="txtRegisterVerifyPassword" name="txtRegisterVerifyPassword" maxlength="256" placeholder="تکرار رمز عبور خود را وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group" style="display: none;">
                    <?php $userRegisterQs = securityQuestion('y', NULL, FALSE, 'userRegisterQs'); ?>
                    <label for="txtLoginQa" class="col-sm-2 control-label">حاصل <?php echo $userRegisterQs['value']; ?>؟</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="txtLoginQa" name="txtLoginQa" placeholder="حاصل عبارت روبرو را وارد نمائید">
                        <input type="hidden" value="<?php echo $userRegisterQs['key']; ?>" class="form-control" name="txtLoginQsK" id="txtLoginQsK">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

 */ ?>

                <div class="form-group">
                    <label class="col-sm-11 control-label">
                        <span id="organCheck">مایلم اعضا و بافت‌های زیر را در زمان مرگم به بیماران نیازمند پیوند عضو، اهدا کنم. </span>
                    </label>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">&nbsp;</div>
                    <?php /*
                    <div class="checkbox col-sm-3">
                        <label for="chRegisterAll">همه‌ی اعضا و نسوج قابل اهدا</label>
                        <input type="checkbox" id="chRegisterAll" name="chRegisterAll">

                    </div>

                    <div class="checkbox col-sm-1">
                        <label for="chRegisterHeart">قلب</label>
                        <input type="checkbox" id="chRegisterHeart" name="chRegisterHeart">
                    </div>

                    <div class="checkbox col-sm-1">
                        <label for="chRegisterLung">ریه</label>
                        <input type="checkbox" id="chRegisterLung" name="chRegisterLung">
                    </div>

                    <div class="checkbox col-sm-1">
                        <label for="chRegisterLiver">کبد</label>
                        <input type="checkbox" id="chRegisterLiver" name="chRegisterLiver">
                    </div>

                    <div class="checkbox col-sm-1">
                        <label for="chRegisterKidney">کلیه</label>
                        <input type="checkbox" id="chRegisterKidney" name="chRegisterKidney">
                    </div>
                    <div class="checkbox col-sm-1">
                        <label for="chRegisterPancreas">پانکراس</label>
                        <input type="checkbox" id="chRegisterPancreas" name="chRegisterPancreas">
                    </div>

                    <div class="checkbox col-sm-1">
                        <label for="chRegisterTissues" class="checkbox">نسوج</label>
                        <input type="checkbox" id="chRegisterTissues" name="chRegisterTissues">
                    </div>
                    */ ?>

                    <div class="col-sm-10">
                        <div class="btn-group" data-toggle="buttons" id="btnGroup">
                            <label for="chRegisterAll" class="btn btn-success btn-sm">همه‌ی اعضا و نسوج قابل اهدا
                                <input type="checkbox" id="chRegisterAll" name="chRegisterAll">
                            </label>

                            <label for="chRegisterHeart" class="btn btn-default btn-sm">قلب
                                <input type="checkbox" id="chRegisterHeart" name="chRegisterHeart">
                            </label>

                            <label for="chRegisterLung" class="btn btn-default btn-sm">ریه
                                <input type="checkbox" id="chRegisterLung" name="chRegisterLung">
                            </label>

                            <label for="chRegisterLiver" class="btn btn-default btn-sm">کبد
                                <input type="checkbox" id="chRegisterLiver" name="chRegisterLiver">
                            </label>

                            <label for="chRegisterKidney" class="btn btn-default btn-sm">کلیه
                                <input type="checkbox" id="chRegisterKidney" name="chRegisterKidney">
                            </label>

                            <label for="chRegisterPancreas" class="btn btn-default btn-sm">پانکراس
                                <input type="checkbox" id="chRegisterPancreas" name="chRegisterPancreas">
                            </label>

                            <label for="chRegisterTissues" class="btn btn-default btn-sm">نسوج
                                <input type="checkbox" id="chRegisterTissues" name="chRegisterTissues">
                            </label>
                        </div>
                    </div>
                </div>
            </form>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div role="alert" class="alert alert-dismissible fade in alertP" id="warningAlert" style="display: none;">
<!--                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>-->
                            <span id="registerFormMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                        </div>
                    </div>
                    <div class="col-sm-4" style="text-align: left; padding-top: 12px;">
                        <div id="divBtn" style="width: 100%;">
                            <button type="button" class="btn btn-warning" style="float: left;" onclick="changeUrl('safir');">انصراف</button>
                            <button type="button" class="btn btn-info" onclick="submitRegisterFormSafir();" style="float: left; margin-left: 10px;">ارسال اطلاعات</button>
                            <button type="button" class="btn btn-primary" id="safirPrintAgain" style="float: left; margin-left: 10px; display: none;">چاپ دوباره کارت</button>
                        </div>
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