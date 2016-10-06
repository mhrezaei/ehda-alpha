    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-family: 'webYekan';">لیست اخبار</h3>
                </div> <div class="panel-body" style="font-family: 'IRANSans', 'Tahoma';">
                    <div class="col-lg-12">

                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="width: 10%;">ردیف</th>
                                <th style="width: 50%;">تیتر خبر</th>
                                <th style="width: 20%;">تاریخ</th>
                                <th style="width: 20%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i = 0, $a = 1; $i < count($news); $i++)
                            {
                                ?>
                            <tr>
                                <th scope="row"><?php echo pd($a++); ?></th>
                                <td><?php echo $news[$i]['title']; ?></td>
                                <td><?php echo pd(pdate('d F Y', $news[$i]['time'])); ?></td>
                                <td>
                                    <a href="<?php echo base_url('manage/home/editNews/' . $news[$i]['id']); ?>" class="glyphicon glyphicon-pencil" style="color: green; cursor: pointer;" data-toggle="tooltip" data-placement="top" title="ویرایش"></a>
                                    <a href="#" onclick="changeTarget('<?php echo base_url('manage/home/manageNews?action=del&id=' . $news[$i]['id']); ?>');" class="glyphicon glyphicon-remove" style="color: red; cursor: pointer;" data-toggle="tooltip" data-placement="top" title="حذف"></a>
                                </td>
                            </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <br>
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


<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>