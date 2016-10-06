<title><?php echo $site_title_fa; ?> | پروفایل شخصی، <?php echo $data['firstName'] . ' ' . $data['lastName']; ?></title>

<div style="clear: both;"></div>
<div class="blueSection">
    <div class="container">
        <h2>پروفایل شخصی، <?php echo $data['firstName'] . ' ' . $data['lastName']; ?></h2>
    </div>
</div>
<div class="container" style="color: #000000;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">مشاهده کارت اهدای عضو ، <?php echo $data['firstName'] . ' ' . $data['lastName']; ?></h3>
        </div>
        <div class="panel-body" style="font-family: 'webYekan', Tahoma;">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8" style="color: #003300; text-align: justify;">
                    همیار گرامی؛
                    <br>
                    مشخصات شما در سامانه کشوری اهدای عضو ثبت گردیده است و این مشخصات در صورت بروز حادثه در تمامی بیمارستان های کشور قابل دسترسی می باشد.
                    <br>
                    می توانید جهت همراه داشتن کارت اهدای عضو خود از طریق دکمه چاپ کارت اقدام نمائید، همچنین می توانید با استفاده از دکمه دریافت کارت، کارت اهدای عضو خود را برروی کامپیوتر شخصی خود ذخیره نمائید.
                </div>
                <div class="col-lg-2"></div>
            </div>

            <div class="row" style="text-align: center; margin: 0 auto; margin-top: 30px;">
                <img src="<?php echo base_url('cardManagement/ehda_card/miniCard/' . $hash) ?>" title=" کارت اهدای عضو ، <?php echo $data['firstName'] . ' ' . $data['lastName']; ?>" style="margin: 0 auto; width: 400px;">
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <a href="<?php echo base_url('cardManagement/ehda_card/fullCardPrint/' . $hash); ?>" class="btn btn-success" target="_blank" >چاپ کارت اهدای عضو</a>
                    <a href="<?php echo base_url('cardManagement/ehda_card/fullCard/' . $hash . '/download'); ?>" class="btn btn-info" target="_blank">دانلود کارت اهدای عضو</a>
                </div>
            </div>

        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>