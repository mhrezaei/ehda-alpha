<!-- nav bar -->

<nav class="navbar navbar-default navbar-fixed-top" style="direction: rtl; text-align: right; display: block;">
    <div class="container-fluid" style="direction: rtl;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" style="float: right;direction: rtl; margin-left: 20px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>" style="padding-top: 8px;">
                <img src="<?php echo asset_url() . 'images/LOGO2.png'; ?>" alt="اهدای عضو، اهدای زندگی">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="direction: rtl;">
            <ul class="nav navbar-nav" style="direction: rtl !important;">
                <li id="navA1"><a href="<?php echo base_url('#home'); ?>" style="font-family: webYekan;">صفحه نخست</a></li>
                <li  id="navA2"><a href="<?php echo base_url('#organ_donate_card'); ?>" style="font-family: webYekan;">کارت اهدای عضو</a></li>

                <li  id="navA3"><a href="<?php echo base_url('#angels'); ?>" style="font-family: webYekan;">فرشتگان ماندگار</a></li>

                <li  id="navA4"><a href="<?php echo base_url('#about'); ?>" style="font-family: webYekan;">درباره ما</a></li>

                <li  id="navA5"><a href="<?php echo base_url('#safiran'); ?>" style="font-family: webYekan;">سفیران</a></li>

                <li  id="navA6"><a href="<?php echo base_url('#partnership'); ?>" style="font-family: webYekan;">مشارکت</a></li>

                <li id="navA8" class="dropdown" style="font-family: 'webYekan', Tahoma;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        تاریخچه
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 13px;">
                        <li><a href="<?php echo base_url('pages/historyInIran'); ?>" style="color: #086E84;">تاریخچه اهدا و پیوند در ایران</a></li>
                        <li><a href="<?php echo base_url('pages/historyInWorld'); ?>" style="color: #086E84;">تاریخچه اهدا و پیوند در جهان</a></li>
                    </ul>
                </li>

                <li id="navA9"><a href="<?php echo base_url('pages/gallery'); ?>" style="font-family: webYekan;">گالری تصاویر</a></li>

                <li id="navA90"><a href="<?php echo base_url('pages/employment'); ?>" style="font-family: webYekan;">استخدام</a></li>

                <li id="navA7"><a href="<?php echo base_url('#contact'); ?>" style="font-family: webYekan;">تماس باما</a></li>

                <?php if($this->users_model->is_user()){ ?>
                <li class="dropdown" style="font-family: 'webYekan', Tahoma;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #086E84;">
                        <?php //echo $data['firstName'] . ' ' . $data['lastName']; ?>
                        پروفایل شخصی
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 13px;">
                        <li><a href="<?php echo base_url('users'); ?>">مشاهده کارت</a></li>
                        <li><a href="<?php echo base_url('cardManagement/ehda_card/fullCard/' . $hash . '/download'); ?>">دریافت کارت</a></li>
                        <li><a href="<?php echo base_url('cardManagement/ehda_card/fullCardPrint/' . $hash); ?>" target="_blank">چاپ کارت</a></li>
                        <li><a href="<?php echo base_url('users/edit'); ?>">ویرایش مشخصات</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#userChangePasswordModal">تغییر رمز عبور</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url('home/logOut'); ?>">خروج</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>

            <ul class="nav navbar-nav navbar-left">
                <li><a href="<?php echo 'https://instagram.com/ehda.center/'; ?>" style="font-family: 'webYekan';" target="_blank">
                        <img src="<?php echo asset_url() . 'images/Instagram-3-Active.png'; ?>" style="width: 20px;" data-toggle="tooltip" data-placement="right" title="ما را در اینستاگرام دنبال کنید..." alt="اینستاگرام اهدای عضو">
                    </a></li>

                <li><a href="<?php echo 'https://telegram.me/ehda_center'; ?>" style="font-family: 'webYekan';" target="_blank">
                        <img src="<?php echo asset_url() . 'images/Telegram_alternative_logo.png'; ?>" style="width: 20px;" data-toggle="tooltip" data-placement="right" title="ما را در کانال تلگرام دنبال کنید..." alt="کانال رسمی اهدای عضو در تلگرام">
                    </a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- nav bar -->

<div style="clear: both"></div>

<script>
    $(document).ready(function(){
        var he = $('nav.navbar').height();
        he = he + 10;
        //$('#extraContent').css({"top":he+"px"});
        $('.cartPos').css({"bottom":he+"px"});
//        $('#ehdaCardTitle').css({"top":he+"px"});
        setTimeout(function(){ onlineNafas(); }, 5000);
    });
</script>