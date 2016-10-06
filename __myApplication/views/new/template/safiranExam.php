<title><?php echo $site_title_fa; ?> | آزمون آنلاین سفیران زندگی</title>

<div style="clear: both;"></div>
    <div class="blueSection">
        <div class="container">
            <h2>آزمون آنلاین سفیران زندگی</h2>
        </div>
    </div>
<div class="container" style="color: #000000;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">آزمون آنلاین سفیران زندگی</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" name="registerForm" id="registerForm">

                <p style="padding: 20px; color: #761c19; font-size: 13px;">
                    توجه: جهت شروع و ثبت آزمون فرم زیر را به دقت تکمیل نموده و برروی دکمه شروع آزمون کلیک نمائید، هر شخص می تواند در یک روز تنها یک بار در آزمون شرکت نماید در نتیجه خواهشمند است به سوالات با دقت پاسخ دهید.
                </p>

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
                    <label for="txtRegisterNationalCode" class="control-label">کدملی:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtRegisterNationalCode" name="txtRegisterNationalCode" data-toggle="tooltip" data-placement="top" title="مثال: 1122114488" maxlength="10" placeholder="کد ملی خود را ده رقمی و بدون خط تیره وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtRegisterEmail" class="control-label">ایمیل:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="email" class="form-control" id="txtRegisterEmail" name="txtRegisterEmail" maxlength="256" data-toggle="tooltip" data-placement="top" title="مثال: you@site.com" placeholder="ایمیل خود را بدون www وارد نمائید">
                </div>

                <div class="form-group">
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                    <div class="col-4" style="text-align: left; padding-top: 12px;">
                        <div id="divBtn" style="width: 100%;">
                            <button type="button" class="btn btn-warning" style="float: left;" onclick="window.location = '<?php echo site_url(); ?>'">انصراف</button>
                            <button type="button" class="btn btn-info" onclick="safiranExam();" style="float: left; margin-left: 10px;">شروع آزمون</button>
                        </div>
                    </div>
                </div>

            </form>


            <form class="form-horizontal" name="saframExam" id="safiranExam" style="font-size: 12px; margin: 0 auto; display: none;">
                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">سوالات آزمون</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <?php
                $allExam = '';
                for($i = 0, $a = 1; $i < count($questions); $i++)
                {
                    if($i == count($questions) - 1)
                    {
                        $allExam .= $questions[$i]['id'];
                    }
                    else
                    {
                        $allExam .= $questions[$i]['id'] . ',';
                    }
                    ?>

                    <?php echo pd($a++); ?>- <?php echo pd($questions[$i]['question']); ?>
                    <div style="width: 90%; color: #002166; margin: 0 auto;">

                        <div class="radio">
                            <label>
                                <input type="radio" value="1" id="answerA<?php echo $questions[$i]['id'];?>" name="answer<?php echo $questions[$i]['id'];?>">
                                الف) <?php echo pd($questions[$i]['answerA']); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" value="2" id="answerB<?php echo $questions[$i]['id'];?>" name="answer<?php echo $questions[$i]['id'];?>">
                                ب) <?php echo pd($questions[$i]['answerB']); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" value="3" id="answerC<?php echo $questions[$i]['id'];?>" name="answer<?php echo $questions[$i]['id'];?>">
                                ج) <?php echo pd($questions[$i]['answerC']); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" value="4" id="answerD<?php echo $questions[$i]['id'];?>" name="answer<?php echo $questions[$i]['id'];?>">
                                د) <?php echo pd($questions[$i]['answerD']); ?>
                            </label>
                        </div>
                        <input type="hidden" id="answerK<?php echo $questions[$i]['id'];?>" name="answerK<?php echo $questions[$i]['id'];?>" value="<?php echo $this->encrypt->encode($questions[$i]['answerTrue']); ?>">

                    </div>
                    <div class="dashtLine" style="background-color: #53B69A; margin-top: 15px; margin-bottom: 15px;"></div>

                <?php
                }
                ?>

                <input type="hidden" value="<?php echo $this->encrypt->encode($allExam); ?>" name="txtQuestions" id="txtQuestions" />
                <input type="hidden" value="" name="txtUserId" id="txtUserId" />
                <input type="hidden" value="" name="txtUserNational" id="txtUserNational" />

                <div id="answersBtn" style="display: block; width: 100%; font-family: 'webYekan', Tahoma;">
                    <button type="button" class="btn btn-warning" style="float: left;" onclick="window.location = '<?php echo site_url(); ?>'">انصراف</button>
                    <button type="button" class="btn btn-success" style="float: left; margin-left: 10px;" id="submitAnswerSheet">ارسال پاسخنامه</button>
                </div>

                <div id="nextLevel" style="display: none; width: 100%; font-family: 'webYekan', Tahoma;">
                    <button type="button" class="btn btn-primary" style="float: left; margin-left: 10px;" id="nextLevelBtn">مرحله بعدی</button>
                </div>

            </form>


            <form class="form-horizontal" name="safiranComplateForm" id="safiranComplateForm" style="display: none;">
                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">تکمیل فرم نهایی</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
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

                <div class="form-group col-6" id="mhrDateTable">
                    <label for="cbRegisterBirthDate" class="control-label">تاریخ تولد:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="cbRegisterBirthDate" name="cbRegisterBirthDate" data-toggle="tooltip" data-placement="top" title="مثال: 1364/12/22" placeholder="ترجیاً از جدول درج خودکار فوق یا با فرمت 1350/9/25 وارد نمائید">
                    <input type="hidden" id="txtExtraBirthday" name="txtExtraBirthday">
                    <script>
                        var date1 = new MHR.persianCalendar('cbRegisterBirthDate',
                            { extraInputID: "txtExtraBirthday", extraInputFormat: "YYYY/MM/DD" });
                    </script>
                </div>

                <div class="form-group col-6">
                    <label for="cbRegisterMaried" class="control-label">وضعیت تاهل:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <select class="form-control" id="cbRegisterMaried" name="cbRegisterMaried" data-toggle="tooltip" data-placement="top" title="مثال: متاهل">
                        <option value="0">انتخاب کنید...</option>
                        <option value="2">مجرد</option>
                        <option value="1">متاهل</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="txtEducation" class="control-label">آخرین مدرک تحصیلی:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtEducation" name="txtEducation" data-toggle="tooltip" data-placement="top" title="مثال: لیسانس حقوق" placeholder="آخرین مدرک تحصیلی">
                </div>

                <div class="form-group col-6">
                    <label for="txtEducationCity" class="control-label">محل اخذ مدرک:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtEducationCity" name="txtEducationCity" data-toggle="tooltip" data-placement="top" title="مثال: تهران" placeholder="محل اخذ مدرک" >
                </div>

                <div class="form-group col-6">
                    <label for="txtNumberOfMonth" class="control-label">چند روز را در ماه می توانید با این مرکز همکاری داشته باشید:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtNumberOfMonth" name="txtNumberOfMonth" data-toggle="tooltip" data-placement="top" title="مثال: 5" placeholder="چند روز را در ماه می توانید با این مرکز همکاری داشته باشید" >
                </div>

                <div class="form-group col-6">
                    <label for="txtJob" class="control-label">شغل فعلی:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtJob" name="txtJob" data-toggle="tooltip" data-placement="top" title="مثال: کارمند بانک" placeholder="شغل فعلی" >
                </div>

                <div style="clear: both;"></div>

                <div class="form-group col-6">
                    <label for="txtHomeAddress" class="control-label">آدرس منزل:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtHomeAddress" name="txtHomeAddress" data-toggle="tooltip" data-placement="top" title="مثال: تهران - میدان ونک - خ شیراز شمالی - خ حکیم اعظم - پ 30" placeholder="آدرس منزل" >
                </div>

                <div class="form-group col-6">
                    <label for="txtJobAddress" class="control-label">آدرس محل کار:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtJobAddress" name="txtJobAddress" data-toggle="tooltip" data-placement="top" title="مثال: تهران - میدان ونک - خ شیراز شمالی - خ حکیم اعظم - پ 30" placeholder="آدرس محل کار">
                </div>

                <div class="form-group col-6">
                    <label for="txtMobile" class="control-label">تلفن همراه:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtMobile" name="txtMobile" data-toggle="tooltip" data-placement="top" title="مثال: 09121234567" maxlength="11" placeholder="تلفن همراه خود را 11 رقمی و بدون خط تیره وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtHomeTel" class="control-label">تلفن منزل:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtHomeTel" name="txtHomeTel" data-toggle="tooltip" data-placement="top" title="مثال: 02122334455" maxlength="11" placeholder="تلفن منزل را 11 رقمی همراه با پیش شماره وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtJobTel" class="control-label">تلفن محل کار:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtJobTel" name="txtJobTel" data-toggle="tooltip" data-placement="top" title="مثال: 02122334455" maxlength="11" placeholder="تلفن محل کار را 11 رقمی همراه با پیش شماره وارد نمائید">
                </div>

                <div class="form-group col-6">
                    <label for="txtEmergencyTel" class="control-label">تلفن ضروری:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtEmergencyTel" name="txtEmergencyTel" data-toggle="tooltip" data-placement="top" title="مثال: 02122334455" maxlength="11" placeholder="تلفن دیگری که در موارد ضروری بتوان با شما تماس گرفت">
                </div>

                <div class="form-group col-12" style="font-size: 12px; font-family: 'webYekan', Tahoma; font-weight: bold;">
                    در کدام یک از فعالیت های زیر مایل به همکاری می باشید ؟
                    <br>
                    <?php
                    for($i = 0; $i < count($safiranActivities); $i++)
                    {
                        ?>

                        <div class="checkbox" style="padding-right: 25px;">
                            <label>
                                <input type="checkbox" value="<?php echo $safiranActivities[$i]['id']; ?>" name="activity[]">
                                <?php echo $safiranActivities[$i]['title']; ?>
                            </label>
                        </div>
                        <div style="clear: both;"></div>

                        <?php
                    }
                    ?>
                </div>

                <div class="form-group col-6">
                    <label for="txtOtherDetail" class="control-label">سایر توضیحات:</label>
                    <input type="text" class="form-control" id="txtOtherDetail" name="txtOtherDetail" data-toggle="tooltip" data-placement="top" title="سایر توضیحاتی که شامل گزینه های فوق نمی باشد" placeholder="سایر توضیحات" >
                </div>

                <div class="form-group col-6">
                    <label for="cbIntroduction" class="control-label">نحوه آشنایی با انجمن اهدای عضو ایرانیان:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <select class="form-control" id="cbIntroduction" name="cbIntroduction" data-toggle="tooltip" data-placement="top" title="مثال: وب سایت">
                        <option value="0">انتخاب کنید...</option>
                        <option value="1">دوستان</option>
                        <option value="2">رسانه ها</option>
                        <option value="3">وب سایت</option>
                        <option value="4">سایر</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="txtFarakhan" class="control-label">نحوه اطلاع از فراخوان جذب سفیر:</label>
                    <span class="glyphicon glyphicon-star colorSur formRequired floatLeft"></span>
                    <input type="text" class="form-control" id="txtFarakhan" name="txtFarakhan" data-toggle="tooltip" data-placement="top" title="مثال: ازطریق دوستان" placeholder="نحوه اطلاع از فراخوان جذب سفیر" >
                </div>

                <div class="form-group col-6">
                    <label for="txtMotivation" class="control-label">انگیزه ی شما از همکاری با انجمن:</label>
                    <input type="text" class="form-control" id="txtMotivation" name="txtMotivation" placeholder="انگیزه ی شما از همکاری با انجمن" >
                    <input type="hidden" value="" name="txtUserData" id="txtUserData" />
                    <input type="hidden" value="" name="txtUserNationalCode" id="txtUserNationalCode" />
                </div>

                <div id="safiranFormBtn" style="display: block; width: 100%; font-family: 'webYekan', Tahoma;">
                    <button type="button" class="btn btn-primary" style="float: left; margin-left: 10px;" onclick="safiranSubmitExtra();" id="lastFormBtn">ارسال اطلاعات</button>
                </div>

            </form>

            <div class="form-group">
                <div class="col-3"></div>
                <div class="col-6">
                    <div role="alert" class="alert alert-dismissible fade in alertP" id="warningAlert" style="display: none; text-align: center; margin: 0 auto;">
                        <!--                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>-->
                        <span id="registerFormMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                    </div>
                </div>
                <div class="col-3" style="text-align: left; padding-top: 12px;"></div>
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