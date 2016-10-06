<title><?php echo $site_title_fa; ?> | ثبت نام کارت اهدای عضو</title>

<div style="clear: both;"></div>
    <div class="blueSection">
        <div class="container">
            <h2>ثبت نام کارت اهدای عضو</h2>
        </div>
    </div>
<div class="container" style="color: #000000;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">فرم ثبت نام کارت اهدای عضو</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" name="registerForm" id="registerForm">

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات فردی</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group col-6">
                    <label class="control-label" for="txtRegisterFirstName">نام:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterFirstName" name="txtRegisterFirstName" data-toggle="tooltip" data-placement="top" title="مثال: محمد" placeholder="نام خود را با حروف فارسی وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterLastName" class="control-label">نام خانوادگی:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterLastName" name="txtRegisterLastName" data-toggle="tooltip" data-placement="top" title="مثال: احمدی" placeholder="نام خانوادگی خود را با حروف فارسی وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="cbRegisterGender" class="control-label">جنسیت:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <select class="form-control" id="cbRegisterGender" name="cbRegisterGender" data-toggle="tooltip" data-placement="top" title="مثال: آقا">
                        <option value="0">انتخاب کنید...</option>
                        <option value="2">خانم</option>
                        <option value="1">آقا</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterFatherName" class="control-label">نام پدر:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterFatherName" name="txtRegisterFatherName" data-toggle="tooltip" data-placement="top" title="مثال: حسین" placeholder="نام پدر را با حروف فارسی وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterIDNumber" class="control-label">شماره شناسنامه:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterIDNumber" name="txtRegisterIDNumber" data-toggle="tooltip" data-placement="top" title="مثال: 137458" placeholder="شماره شناسنامه خود را به صورت عددی وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterNationalCode" class="control-label">کدملی:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterNationalCode" name="txtRegisterNationalCode" data-toggle="tooltip" data-placement="top" title="مثال: 1122114488" maxlength="10" placeholder="کد ملی خود را ده رقمی و بدون خط تیره وارد نمائید">
                    <input type="hidden" name="txtDbCheck" id="txtDbCheck" value="0">
                </div>

                <div class="form-group col-6" id="mhrDateTable">
                    <label for="cbRegisterBirthDate" class="control-label">تاریخ تولد:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                        <input type="text" class="form-control" id="cbRegisterBirthDate" name="cbRegisterBirthDate" data-toggle="tooltip" data-placement="top" title="مثال: 1364/12/22" placeholder="ترجیحاً از جدول درج خودکار فوق یا با فرمت 1350/9/25 وارد نمائید">
                    <input type="hidden" id="txtExtraBirthday" name="txtExtraBirthday">
                    <script>
                        var date1 = new MHR.persianCalendar('cbRegisterBirthDate',
                            { extraInputID: "txtExtraBirthday", extraInputFormat: "YYYY/MM/DD" });
                    </script>
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterPlaceOfBirth" class="control-label">محل تولد:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterPlaceOfBirth" name="txtRegisterPlaceOfBirth" data-toggle="tooltip" data-placement="top" title="شیراز" placeholder="محل تولد خود را با حروف فارسی وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="cbRegisterEducation" class="control-label">میزان تحصیلات:</label>
                    <select class="form-control" id="cbRegisterEducation" name="cbRegisterEducation" data-toggle="tooltip" data-placement="top" title="مثال: لیسانس">
                        <option value="0">انتخاب کنید...</option>
                        <option value="1">زیر دیپلم</option>
                        <option value="2">دیپلم</option>
                        <option value="3">کاردانی</option>
                        <option value="4">کارشناسی</option>
                        <option value="5">کارشناسی‌ارشد</option>
                        <option value="6">دکترا و بالاتر</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterJob" class="control-label">شغل:</label>
                    <input type="text" class="form-control" id="txtRegisterJob" name="txtRegisterJob" data-toggle="tooltip" data-placement="top" title="مثال: کارمند بانک" placeholder="در صورت تکمیل نمودن با حروف فارسی وارد نمائید">
                </div>

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات تماس</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterMobile" class="control-label">تلفن همراه:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterMobile" name="txtRegisterMobile" data-toggle="tooltip" data-placement="top" title="مثال: 09121234567" maxlength="11" placeholder="تلفن همراه خود را 11 رقمی و بدون خط تیره وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterTel" class="control-label">تلفن ثابت:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterTel" name="txtRegisterTel" data-toggle="tooltip" data-placement="top" title="مثال: 02122334455" maxlength="11" placeholder="تلفن ثابت را 11 رقمی همراه با پیش شماره وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="cbRegisterState" class="control-label">استان:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <select class="form-control" id="cbRegisterState" name="cbRegisterState" data-toggle="tooltip" data-placement="top" title="مثال: تهران" onchange="selectCity();">
                        <option value="0">انتخاب کنید...</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="cbRegisterCity" class="control-label">شهر:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <select class="form-control" id="cbRegisterCity" name="cbRegisterCity" data-toggle="tooltip" data-placement="top" title="مثال: تهران">
                        <option value="0">انتخاب کنید...</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterEmail" class="control-label">ایمیل:</label>
                    <input type="email" class="form-control" id="txtRegisterEmail" name="txtRegisterEmail" maxlength="256" data-toggle="tooltip" data-placement="top" title="مثال: you@site.com" placeholder="ایمیل خود را بدون www وارد نمائید">
                </div>

                <div style="clear: both;"></div>

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">اطلاعات ورود به سامانه</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterUsername" class="control-label">نام کاربری:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterUsername" name="txtRegisterUsername" maxlength="256" data-toggle="tooltip" data-placement="top" title="مثال: amirali256" placeholder="نام کاربری را با حروف انگلیسی یا عدد و حداقل 6 کاراکتر بدون فاصله وارد نمائید">
                </div>

                <div style="clear: both;"></div>

                <div class="form-group col-6">
                    <label for="txtRegisterPassword" class="control-label">رمز عبور:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="password" class="form-control" id="txtRegisterPassword" name="txtRegisterPassword" maxlength="256" placeholder="رمز عبور را با حروف انگلیسی یا عدد و حداقل 6 کاراکتر بدون فاصله وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterVerifyPassword" class="control-label">تکرار رمز عبور:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="password" class="form-control" id="txtRegisterVerifyPassword" name="txtRegisterVerifyPassword" maxlength="256" placeholder="تکرار رمز عبور خود را وارد نمائید">
                </div>

                <div class="form-group" style="display: none;">
                    <?php $userRegisterQs = securityQuestion('y', NULL, FALSE, 'userRegisterQs'); ?>
                    <label for="txtLoginQa" class="col-2 control-label">حاصل <?php echo $userRegisterQs['value']; ?>؟</label>
                    <div class="col-9">
                        <input type="password" class="form-control" id="txtLoginQa" name="txtLoginQa" placeholder="حاصل عبارت روبرو را وارد نمائید">
                        <input type="hidden" value="<?php echo $userRegisterQs['key']; ?>" class="form-control" name="txtLoginQsK" id="txtLoginQsK">
                    </div>
                    <div class="col-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-12 control-label">
                        <span id="organCheck">مایلم اعضا و بافت‌های زیر را در زمان مرگم به بیماران نیازمند پیوند عضو، اهدا کنم. </span>
                    </label>
                </div>
                <div class="form-group">
                    <?php /*
                    <div class="checkbox col-3">
                        <label for="chRegisterAll">همه‌ی اعضا و نسوج قابل اهدا</label>
                        <input type="checkbox" id="chRegisterAll" name="chRegisterAll">

                    </div>

                    <div class="checkbox col-1">
                        <label for="chRegisterHeart">قلب</label>
                        <input type="checkbox" id="chRegisterHeart" name="chRegisterHeart">
                    </div>

                    <div class="checkbox col-1">
                        <label for="chRegisterLung">ریه</label>
                        <input type="checkbox" id="chRegisterLung" name="chRegisterLung">
                    </div>

                    <div class="checkbox col-1">
                        <label for="chRegisterLiver">کبد</label>
                        <input type="checkbox" id="chRegisterLiver" name="chRegisterLiver">
                    </div>

                    <div class="checkbox col-1">
                        <label for="chRegisterKidney">کلیه</label>
                        <input type="checkbox" id="chRegisterKidney" name="chRegisterKidney">
                    </div>
                    <div class="checkbox col-1">
                        <label for="chRegisterPancreas">پانکراس</label>
                        <input type="checkbox" id="chRegisterPancreas" name="chRegisterPancreas">
                    </div>

                    <div class="checkbox col-1">
                        <label for="chRegisterTissues" class="checkbox">نسوج</label>
                        <input type="checkbox" id="chRegisterTissues" name="chRegisterTissues">
                    </div>
                    */ ?>

                    <div class="col-12">
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
                        <span class="glyphicon glyphicon-star colorSur formRequired" style="padding-top: 8px; padding-right: 5px;"></span>
                    </div>
                </div>
            </form>
                <div class="form-group">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div role="alert" class="alert alert-dismissible fade in alertP" id="warningAlert" style="display: none;">
<!--                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>-->
                            <span id="registerFormMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                        </div>
                    </div>
                    <div class="col-4" style="text-align: left; padding-top: 12px;">
                        <div id="divBtn" style="width: 100%;">
                            <button type="button" class="btn btn-warning" style="float: left;" onclick="window.location = '<?php echo site_url('home/organDonation'); ?>'">انصراف</button>
                            <button type="button" class="btn btn-info" onclick="submitRegisterForm();" style="float: left; margin-left: 10px;">ارسال اطلاعات</button>
                        </div>
                        <div id="dbCheckBtn" style="display: none; width: 100%;">
                            <button type="button" class="btn btn-warning" style="float: left;" onclick="window.location = '<?php echo site_url('home/organDonation'); ?>'">انصراف</button>
                            <button type="button" class="btn btn-danger" style="float: left; margin-left: 10px;" id="dbCheckEditBtn">ویرایش اطلاعات</button>
                            <button type="button" class="btn btn-success" style="float: left; margin-left: 10px;" id="dbCheckVerifyBtn">تایید اطلاعات</button>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 0 auto;">
                    <div class="col-12">
                        <div class="progress" style="display: none; margin: 0 auto; margin-top: 15px; width: 50%;">
                            <div class="progress-bar progress-bar-success progress-bar-striped active" id="progressVal" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <span style="font-family: 'webYekan', Tahoma;">شکیبا باشید...</span>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>