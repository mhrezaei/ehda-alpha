    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-family: 'webYekan';">افزودن خبر</h3>
                </div> <div class="panel-body" style="font-family: 'IRANSans', 'Tahoma';">
                    <div class="col-lg-12">

                        <?php
                        if ($insert == 1)
                        {
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible fade in">
                                <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                خبر مورد نظر با موفقیت ذخیره گردید.
                            </div>
                        <?php
                        }
                        ?>

                        <form method="post" name="addNewsForm">
                            <div class="form-group">
                                <label for="txtTitle">تیتر خبر</label>
                                <input type="email" class="form-control" id="txtTitle" name="txtTitle" placeholder="تیتر خبر" value="<?php echo $news['title']; ?>">
                            </div>

                            <div style="clear: both;"></div>

                            <div class="form-group">
                                <label for="txtDate">تاریخ</label>
                                <input type="text" class="form-control txtDate" id="txtDate" name="txtDate" placeholder="تاریخ خبر" value="<?php echo pdate('Y/m/d', $news['time']); ?>">
                                <input type="hidden" id="txtExtraDate" name="txtExtraDate" value="<?php echo date('Y/m/d', $news['time']); ?>">
                                <script>
                                    var date1 = new MHR.persianCalendar('txtDate',
                                        { extraInputID: "txtExtraDate", extraInputFormat: "YYYY/MM/DD" });
                                </script>
                            </div>

                            <div style="clear: both;"></div>

                            <div class="form-group">
                                <label for="txtContent">متن</label>
                                <br>
                                <textarea class="form-control" id="txtContent" name="txtContent" rows="10" cols="80"><?php echo htmlCoding($news['content'], 2); ?></textarea>
                            </div>

                            <div style="clear: both;"></div>
                            <br>
                            <br>

                        </form>

                        <br>
                        <button type="button" onclick="addNews();" class="btn btn-success" style="font-size: 12px;">ارسال خبر</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<div style="clear:both;"></div>
<!--three section end-->

<script src="<?php echo asset_url(); ?>ckeditor/ckeditor.js"></script>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    function testtest()
    {
        alert($(document).width());
        alert($(window).width());
    }
    CKEDITOR.config.height = 400;
    CKEDITOR.replace('txtContent');

    function addNews() {
        var title = $('#txtTitle');
        var date = $('#txtDate');
        var extraDate = $('#txtExtraDate');
        var content = CKEDITOR.instances.txtContent.getData();

        if (title.val().length > 5 && extraDate.val().length > 4 && content.length > 10)
        {
            document.addNewsForm.submit();
        }
        else
        {
            alert('تمامی گزینه ها را به درستی تکمیل نمائید.');
        }

    }
</script>

    <style>
        .cke_contents{
            width: 100% !important;
        }
    </style>