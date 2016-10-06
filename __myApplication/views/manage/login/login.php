<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>انجمن اهدای عضو ایرانیان | ورود</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>login/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset_url(); ?>login/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset_url(); ?>login/css/form-elements.css">
    <link rel="stylesheet" href="<?php echo asset_url(); ?>login/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 form-box">
                    <div class="form-top">
                        <div class="form-top-left" style="text-align: right;">
                            <h3>ورود به سامانه</h3>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="" method="post" class="login-form">
                            <div class="form-group">
                                <label class="sr-only" for="txtUsername">Username</label>
                                <input type="text" name="txtUsername" placeholder="نام کاربری" class="form-username form-control" id="txtUsername">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="txtPassword">Username</label>
                                <input type="password" name="txtPassword" placeholder="رمز عبور" class="form-username form-control" id="txtPassword">
                            </div>
                            <div class="form-group">
                                <?php
                                    $contactQs = securityQuestion('y', NULL, FALSE, 'loginPage');
                                ?>
                                <label class="sr-only" for="txtQuestion">Password</label>
                                <input type="text" name="txtQuestion" placeholder="حاصل عبارت <?php echo pd($contactQs['value']); ?>؟" class="form-password form-control" id="txtQuestion">
                                <input type="hidden"  name="txtQuestionKey" id="txtQuestionKey" value="<?php echo $contactQs['key']; ?>" />
                            </div>
                            <button type="submit" class="btn" style="direction: rtl;">ورود!</button>
                        </form>
                        <div style="direction: rtl; text-align: center; font-size: 11px; color: red;">
                            <?php if($err == 1){ ?>
                            اطلاعات را به درستی وارد نمائید.
                            <?php }elseif($err == 2){ ?>
                            پاسخ سوال امنیتی صحیح نیست.
                            <?php }elseif($err == 3){ ?>
                            نام کاربری/رمز عبور صحیح نمی باشد.
                            <?php } ?>
                        </div>
                        <div style="direction: rtl; text-align: right; font-size: 11px;">
                            <a href="#">رمز خود را فراموش کرده اید؟</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="<?php echo asset_url(); ?>login/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo asset_url(); ?>login/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo asset_url(); ?>login/js/jquery.backstretch.min.js"></script>
<script src="<?php echo asset_url(); ?>login/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="<?php echo asset_url(); ?>login/js/placeholder.js"></script>
<![endif]-->

<script>
    jQuery(document).ready(function () {
        $.backstretch("<?php echo asset_url(); ?>login/img/backgrounds/1.jpg");
    });
</script>

</body>

</html>
<?php $this->output->enable_profiler(FALSE); ?>