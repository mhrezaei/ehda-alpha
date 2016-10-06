<div class="container">
    <div class="panel panel-default" style="margin-top: 5em;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">لیست فرم های استخدام</h3>
        </div>
        <div class="panel-body" style="font-family: 'BNazanin', Tahoma; font-size: 16px;">
            <div class="row">
                <div class="col-md-12">

                    <?php if(!$forms){ ?>
                        <div class="row" style="text-align: center; color: #ff0000; font-family: 'webYekan', Tahoma; margin-top: 50px; margin-bottom: 50px;">رکوردی جهت نمایش یافت نشد.</div>
                    <?php }else{ ?>
                        <div class="row" style="font-family: 'webYekan', Tahoma; text-align: right; color: #00CC00; font-size: 13px; padding-right: 20px;">تعداد کل فرم های ثبت شده: <?php echo count($forms); ?></div>

                        <table class="table table-hover" style="margin-top: 25px;">
                            <thead>
                            <tr>
                                <th class="col-md-1">ردیف</th>
                                <th class="col-md-10">اطلاعات عمومی</th>
                                <th class="col-md-1">امکانات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i = 0, $a = 1; $i < count($forms); $i++, $a++){ ?>
                            <tr>
                                <th scope="row"><?php echo $a; ?></th>
                                <td>
                                    نام: <span style="color: #265A88;"><?php echo $forms[$i]['name']; ?></span><br>
                                    سن: <span style="color: #265A88;"><?php echo $forms[$i]['age']; ?></span><br>
                                    وضعیت تاهل: <span style="color: #265A88;"><?php if($forms[$i]['mar'] == 1){echo 'مجرد';}else{echo 'متاهل';} ?></span><br>
                                    مدرک تحصیلی: <span style="color: #265A88;"><?php echo $forms[$i]['edu']; ?></span><br>
                                    رشته تحصیلی: <span style="color: #265A88;"><?php echo $forms[$i]['eduType']; ?></span><br>
                                    شغل کنونی: <span style="color: #265A88;"><?php echo $forms[$i]['nJob']; ?></span><br>
                                    تفن همراه: <span style="color: #265A88;"><?php echo $forms[$i]['mobile']; ?></span><br>
                                    تلفن ثابت: <span style="color: #265A88;"><?php echo $forms[$i]['tel']; ?></span><br>
                                    آدرس محل سکونت: <span style="color: #265A88;"><?php echo $forms[$i]['address']; ?></span><br>
                                    نام و آدرس محل کار فعلی: <span style="color: #265A88;"><?php echo $forms[$i]['aJob']; ?></span><br>
                                    تلفن محل کار فعلی: <span style="color: #265A88;"><?php echo $forms[$i]['tJob']; ?></span><br>
                                    ایمیل: <span style="color: #265A88;"><?php echo $forms[$i]['email']; ?></span><hr>
                                    <span style="display: none;" id="exData<?php echo $forms[$i]['id']; ?>">
                                    سوابق شغلی: <span style="color: #265A88;"><?php echo $forms[$i]['oJob']; ?></span><hr>
                                    مدارک: <span style="color: #265A88;"><?php echo $forms[$i]['doc']; ?></span><hr>
                                    نحوه آشنایی: <span style="color: #265A88;"><?php echo $forms[$i]['rel']; ?></span><br>
                                    حقوق پیشنهادی: <span style="color: #265A88;"><?php echo $forms[$i]['pr']; ?></span><br>
                                        </span>
                                </td>
                                <td>
                                    <span class="glyphicon glyphicon-eye-open" style="color: green; cursor: pointer;" onclick="showExData(<?php echo $forms[$i]['id']; ?>);"></span>
                                    <a href="<?php echo base_url('estekhdam/printForm/' . $forms[$i]['id']); ?>" target="_blank" class="glyphicon glyphicon-print"></a>
                                    <span class="glyphicon glyphicon-remove" style="color: #ff0000; cursor: pointer;" onclick="deleteFrom(<?php echo $forms[$i]['id']; ?>);"></span>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>

                </div>

            </div>

        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>

<script>
    function deleteFrom(id)
    {
        if(confirm('آیا مایل به حذف این فرم می باشید؟'))
        {
            window.location = base_url() + 'estekhdam/delForm/' + id;
        }
    }

    function showExData(id)
    {
        $('#exData' + id).slideToggle(500);
    }
</script>