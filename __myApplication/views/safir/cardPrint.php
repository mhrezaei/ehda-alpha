<div class="container">
    <div class="panel panel-default" style="margin-top: 5em;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">لیست کارت های در انتظار چاپ</h3>
        </div>
        <div class="panel-body" style="font-family: 'BNazanin', Tahoma; font-size: 16px;">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">

                    <?php if($status != 1){ ?>
                        <div class="row" style="text-align: center; color: #ff0000; font-family: 'webYekan', Tahoma; margin-top: 50px; margin-bottom: 50px;">رکوردی جهت نمایش یافت نشد.</div>
                    <?php }else{ ?>
                        <div class="row" style="font-family: 'webYekan', Tahoma; text-align: right; color: #00CC00; font-size: 13px;">نمایش تعداد <?php echo count($users); ?> عدد کارت از مجموع <?php echo $total; ?> عدد</div>

                        <table class="table table-hover" style="margin-top: 25px;">
                            <thead>
                            <tr>
                                <th class="col-md-1">ردیف</th>
                                <th class="col-md-1">شماره عضویت</th>
                                <th class="col-md-2">نام</th>
                                <th class="col-md-2">نام خانوادگی</th>
                                <th class="col-md-2">نام پدر</th>
                                <th class="col-md-2">کدملی</th>
                                <th class="col-md-2">تاریخ تولد</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i = 0, $a = 1; $i < count($users); $i++, $a++){ ?>
                            <tr>
                                <th scope="row"><?php echo $a; ?></th>
                                <td><?php echo $users[$i]['memberID']; ?></td>
                                <td><?php echo $users[$i]['data']['firstName']; ?></td>
                                <td><?php echo $users[$i]['data']['lastName']; ?></td>
                                <td><?php echo $users[$i]['data']['fatherName']; ?></td>
                                <td><?php echo $users[$i]['nationalcode']; ?></td>
                                <td><?php echo pdate('Y/m/d', $users[$i]['data']['dateOfBirth']); ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>

                </div>
                <div class="col-md-1"></div>

            </div>

            <?php if($status == 1){ ?>
            <div class="row" style="margin-top: 50px; text-align: left; margin-left: 30px;">
                <a href="<?php echo base_url('safir/printer?ids=' . $ids); ?>" class="btn btn-info" target="_blank">چاپ کارت ها</a>
                <a href="<?php echo base_url('safir/verifyPrint?ids=' . $ids); ?>" class="btn btn-warning">تایید کارت ها پس از چاپ</a>
            </div>
            <?php } ?>

        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>