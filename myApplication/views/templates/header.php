<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo asset_url(); ?>css/reset.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/js-persian-cal.css" rel="stylesheet" type="text/css">
    <link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo asset_url(); ?>js/jquery.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/custom.js?time=<?php echo time(); ?>"></script>
    <script src="<?php echo asset_url(); ?>js/js-persian-cal.patients.js?time=<?php echo time(); ?>"></script>
    <script src="<?php echo asset_url(); ?>js/jquery.form.min.js?time=<?php echo time(); ?>"></script>
    <script src="<?php echo asset_url(); ?>js/formEffects.js?time=<?php echo time(); ?>"></script>

    <script src="<?php echo asset_url(); ?>js/ui/jquery-ui.min.js?time=<?php echo time(); ?>"></script>
    <link href="<?php echo asset_url(); ?>js/ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <title>وزارت بهداشت، درمان و آموزش پزشکی | اداره پیوند و بیماری های خاص | درخواست کارت اهدای عضو</title>
</head>
<body>

<div id="extraContent">
    <div class="iranFlag"></div>
    <div class="leader"></div>
    <div class="behdasht"></div>
</div>

<div style="clear: both;"></div>

<div class="bgOne"></div>

<div style="clear: both;"></div>

<div class="cartBg" data-toggle="modal" data-target="#ehdaCardModal"></div>
<div class="cartBgTwo" data-target="#ehdaCardModal" data-toggle="modal" style="display: none; background-position: left top;"></div>

<?php
    $this->view('templates/ehdaCardDetailModal');
    $this->view('templates/ehdaCardLoginForm');
    $this->view('templates/ehdaCardModal');
    $this->view('templates/forgotPasswordModal');
?>