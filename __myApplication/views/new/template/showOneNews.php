<title><?php echo $site_title_fa; ?> | <?php echo $news['title']; ?></title>

<div style="clear: both;"></div>
<div class="blueSection">
    <div class="container">
        <h2>اخبار اهدای عضو</h2>
    </div>
</div>
<div class="container" style="color: #000000;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;"><?php echo $news['title']; ?></h3>
        </div>
        <div class="panel-body" style="text-align: justify; font-size: 12px;">
            <div class="col-1"></div>
            <div class="col-10">
                <?php echo htmlCoding($news['content'], 2); ?>
                <br>
                <br>
                تاریخ خبر: <?php echo pd(pdate('d F Y', $news['time'])); ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>