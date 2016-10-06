<div class="container">
    <div class="panel panel-default" style="margin-top: 5em;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">لیست کارت های در انتظار چاپ</h3>
        </div>
        <div class="panel-body" style="font-family: 'BNazanin', Tahoma; font-size: 16px;">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">

                    <?php if(isset($pvc) and $pvc == 'ok'){ ?>
                        <div class="row" style="text-align: center; color: #3ab637; font-family: 'webYekan', Tahoma; margin-top: 50px; margin-bottom: 50px;">کارت های انتخاب شده به صف چاپ PVC اضافه شد.</div>
                    <?php } ?>

                    <?php if($status != 1){ ?>
                        <div class="row" style="text-align: center; color: #ff0000; font-family: 'webYekan', Tahoma; margin-top: 50px; margin-bottom: 50px;">رکوردی جهت نمایش یافت نشد.
                            <br>
                            <button type="button" class="btn btn-warning" style="margin-top: 20px;" onclick="changeUrl('safir/printCard');">بروزرسانی لیست کارت ها</button>
                        </div>
                    <?php }else{ ?>
                        <form method="post" action="<?php echo base_url(); ?>safir/printCard">
                        <div class="row" style="font-family: 'webYekan', Tahoma; text-align: right; color: #00CC00; font-size: 13px;">نمایش تعداد <?php echo count($users); ?> عدد کارت از مجموع <?php echo $total; ?> عدد
                            <button type="button" class="btn btn-success btn-sm" style="" onclick="changeUrl('safir/printCard');"><span class="glyphicon glyphicon-refresh"></span> بروزرسانی لیست کارت ها</button>
                        </div>
                        <table class="table table-hover" style="margin-top: 25px;">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th id="selectAll" style="cursor: pointer;">انتخاب همه</th>
                                <th>شماره عضویت</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>نام پدر</th>
                                <th>کدملی</th>
                                <th>تاریخ تولد</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i = 0, $a = 1; $i < count($users); $i++, $a++)
                            {
                                $check = '';
                                if ($this->input->post('ids'))
                                {
                                    if (in_array($users[$i]['id'], $this->input->post('ids')))
                                    {
                                        $check = 'checked="checked"';
                                    }
                                }
                                ?>
                            <tr>
                                <th scope="row"><?php echo $a; ?></th>
                                <td><input type="checkbox" name="ids[]" value="<?php echo $users[$i]['id']; ?>" <?php echo $check; ?>></td>
                                <td><?php echo $users[$i]['memberID']; ?></td>
                                <td><?php echo $users[$i]['data']['firstName']; ?></td>
                                <td><?php echo $users[$i]['data']['lastName']; ?></td>
                                <td><?php echo $users[$i]['data']['fatherName']; ?></td>
                                <td><a href="<?php echo base_url(); ?>safir/editOneUser?txtnationalcode=<?php echo $users[$i]['nationalcode']; ?>" target="_blank"><?php echo $users[$i]['nationalcode']; ?></a></td>
                                <td><?php echo pdate('Y/m/d', $users[$i]['data']['dateOfBirth']); ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                            <?php if($status == 1){ ?>
                                <div class="row" style="margin-top: 50px; text-align: left; margin-left: 30px;">
                                    <a href="<?php echo base_url('safir/printer?ids=' . $ids); ?>" class="btn btn-info" target="_blank">چاپ کارت ها</a>
                                    <a href="<?php echo base_url('safir/verifyPrint?ids=' . $ids); ?>" class="btn btn-warning">تایید کارت ها پس از چاپ</a>
                                </div>
                                <div class="row" style="margin-top: 50px; text-align: left; margin-left: 30px;">
                                    <button type="submit" value="pvcPrint" name="pvcPrint" class="btn btn-info">چاپ کارت به صورت PVC</button>
                                    <button type="submit" value="verifyPvcPrint" name="verifyPvcPrint" class="btn btn-warning">تایید کارت ها پس از چاپ PVC</button>
                                </div>
                            <?php } ?>
                        </form>
                    <?php } ?>

                </div>
                <div class="col-md-1"></div>

            </div>

        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>
<script>
    $('#selectAll').click(function() {
        $(':checkbox').each(function() {
            if (this.checked)
            {
                this.checked = false;
            }
            else
            {
                this.checked = true;
            }
        });
    });
</script>