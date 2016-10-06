<div class="section " id="section1">
    <div class="intro">
        <div class="container">
            <div class="col-md-12 ehdaCardTitle" style="margin-top: 5em; color: #201b63;" id="ehdaCardTitle">
                <h2>کارت اهدای عضو</h2>
            </div>

            <div class="col-md-12" id="ehdaCardContent">
                <div class="row ehdaCardP" style="font-family: 'IRANSans', 'Tahoma'; font-style: normal; font-size: 15px;">

                    <div class="col-md-8" style="padding-top: 10px; color: #201b63;">

                        کارت اهدای عضو یکی از بزرگترین نمادهای فرهنگی در زمینه ارتقای فرهنگ اهدای عضو می باشد.
                        <br />

                        از زمان راه اندازی واحدهای فراهم آوری اعضای پیوندی در کشورمان، مراکز مختلفی شروع به ثبت نام و صدور کارت اهدای عضو نمودند. در روزها و ماه‌های اول تعداد ثبت نام به بیش از 100 نفر در ماه نمیرسید، اما با شروع تبلیغات فرهنگی و برگزاری جشن نفس، تعداد بیشتری از مردم نیک اندیش سرزمینمان با این امر مقدس آشنا شدند و تعداد افراد متقاضی کارت اهدای عضو به بیش از 500 نفر در روز رسید...
                        <br />

                        تقاضای دریافت کارت اهدای عضو روز به روز بیشتر شد، به اندازه ای که مدت زمان دریافت کارت اهدای عضو برای هر فرد به بیش از 5ماه رسید. باتوجه به اینکه کارت اهدای عضو صرفاً نشان دهنده رضایت قلبی هر شخص برای اهدای عضو در زمان مرگ میباشد و جنبه‌‌ی قانونی ندارد؛ لذا بر آن شدیم تا سامانه ای راه اندازی کنیم که مدت زمان دریافت کارت را به طرز چشمگیری کاهش دهد تا انتظار رسیدن این کارت، مردم ایثارگر میهن عزیزمان را آزرده خاطر نسازد.
                        <br />

                        با توجه به مسائل فوق و همچنین پیرو تاکید مقام محترم وزارت بهداشت، درمان و آموزش پزشکی، ابداع روشی برای ثبت نام و صدور آنی کارت اهدای عضو در دستور کار این وزارت قرار گرفت و نتیجه تمامی بررسی ها، سامانه ای است که پیش روی شما می باشد. در این سامانه کد ملی هر فرد به صورت آنلاین کنترل شده و در صورتیکه اطلاعات مطابق کارت ملی وارد شده باشد، کارت اهدای عضو صادر شده و متقاضی میتواند همان لحظه کارت خود را ذخیره و چاپ نماید.
                        <br />

                        اطلاعات داوطلبین دریافت کارت بلافاصله وارد سامانه کشوری کارت اهدای عضو شده و در آن ذخیره می گردد. لازم به ذکر است این سامانه از طریق کلیه بیمارستانهای کشور قابل دسترسی بوده و امکان جستجوی نام افراد مرگ مغزی بستری در این بیمارستانها وجود دارد.
                        <br />

                        امید است با راه اندازی این سامانه قدمی هرچند کوچک برای ارتقای فرهنگ مقدس اهدی عضو و نجات جان بیماران نیازمند به پیوند اعضا برداریم...
                        <br /><br />
                        <strong>
                            درصورتی که قبلاً در این سامانه ثبت نام کرده اید، جهت ویرایش اطلاعات شخصی و یا چاپ مجدد کارت خود برروی دکمه ورود به سامانه کلیک نمائید، در غیر اینصورت جهت ثبت نام و دریافت کارت اهدای عضو خود برروی دکمه ثبت نام کارت اهدای عضو کلیک نمائید. </p>
                        </strong>

                    </div>
                    <div class="col-md-4" style="text-align: center;">

                        <?php if(!$this->users_model->is_user()){ ?>
                            <img src="<?php echo asset_url() . 'images/cardMini_S.png'; ?>" class="borderRadius" style="width: 100%; margin-top: 25px; max-width: 345px;" alt="کارت اهدای عضو">
                        <?php }else{ ?>
                        <img src="<?php echo base_url('cardManagement/ehda_card/miniCard/' . $hash) ?>" class="borderRadius" style="width: 100%; margin-top: 25px; max-width: 345px;" alt="کارت اهدای عضو">
                        <?php } ?>

                    </div>

                </div>
            </div>

            <!-- login form -->
            <div class="col-md-12 borderRadius" id="loginForm" style="display: none; margin-bottom: 50px; background-color: #e0d6c8; margin-top: 25px;">
                <div class="ehdaCardP">
                <form class="form-horizontal" name="loginForm">
                    <div class="form-group">
                        <label for="txtLoginUsername" class="col-sm-2 control-label">نام کاربری:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtLoginUsername" name="txtLoginUsername" placeholder="نام کاربری یا کدملی خود را وارد نمائید.">
                            <span class="glyphicon glyphicon-user form-control-feedback colorSur" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtLoginPassword" class="col-sm-2 control-label">رمز عبور:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="txtLoginPassword" name="txtLoginPassword" placeholder="رمز عبور خود را وارد نمائید">
                            <span class="glyphicon glyphicon-lock form-control-feedback colorSur" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php $userLoginQs = securityQuestion('y', NULL, FALSE, 'userLoginQs'); ?>
                        <label for="txtLoginQa" class="col-sm-2 control-label" id="qaLabel">حاصل <?php echo $userLoginQs['value']; ?>؟</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtLoginQa" name="txtLoginQa" placeholder="حاصل عبارت روبرو را وارد نمائید">
                            <span class="glyphicon glyphicon-lock form-control-feedback colorSur" aria-hidden="true"></span>
                            <input type="hidden" value="<?php echo $userLoginQs['key']; ?>" class="form-control" name="txtLoginQsK" id="txtLoginQsK">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">
                            <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">رمز عبور خود را فراموش کرده اید؟</a>
                        </div>
                        <div class="col-md-4">
                            <div role="alert" class="alert alert-warning alert-dismissible fade in alertP" id="loginFormAlert" style="display: none;">
                                <span id="loginFormMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                            </div>
                        </div>
                        <div class="col-sm-4" style="text-align: left; padding-top: 12px;" id="loginBtns">
                            <button type="button" class="btn btn-warning" onclick="loginFormTog();" style="float: left;">انصراف</button>
                            <button type="button" class="btn btn-info" style="float: left; margin-left: 10px;" onclick="userLogin();">ورود</button>
                        </div>
                    </div>

                    <!-- loading start -->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="progress" style="display: none; margin-top: 15px;">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" id="progressVal" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span style="font-family: 'webYekan', Tahoma;">شکیبا باشید...</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <!-- loading ehda -->

                </form>
                </div>
            </div>
            <!-- login form -->

            <div class="row" style="clear: both; margin-top: 50px;"></div>
            <div class="col-md-12" style="text-align: left; margin-top: 30px; padding-left: 30px;" id="loginRegisterBtn">
                <?php if($this->users_model->is_user()){ ?>
                    <button class="btn btn-primary" style="font-family: webYekan;" onclick="changeUrl('users')">پروفایل شخصی</button>
                <?php }else{ ?>
                    <a href="<?php site_url(); ?>home/register" class="btn btn-success" style="font-family: 'webYekan', Tahoma">ثبت نام کارت اهدای عضو</a>
                    <button class="btn btn-info" style="font-family: webYekan;" onclick="loginFormTog();">ورود به سامانه</button>
                <?php } ?>
            </div>

        </div>
        <div style="clear: both; margin-top: 30px;"></div>

    </div>
</div>