<?php if (count($invite)){ ?>
<style>
    body{
        background: white !important;
    }
</style>
    <table class="table table-bordered table-responsive table-striped table-hover" style="font-family: 'IRANSans', 'Tahoma'; font-size: 16px;">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>نام و نام خانوادگی</th>
                <th>پارکینگ</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0, $a = 1; $i < count($invite); $i++){ ?>
                <tr style="background: <?php if ($invite[$i]['parck'] == 1){echo 'gold';} ?>;">
                    <th><?php echo pd($a++); ?></th>
                    <td><?php echo $invite[$i]['name']; ?></td>
                    <td><?php if ($invite[$i]['parck'] == 1){echo 'ویژه';}else{echo 'عادی';} ?></td>
                    <td>
                        <?php if ($invite[$i]['status'] == 1){ ?>
                            <button id="loginVis<?php echo $invite[$i]['id'];?>" onclick="todo(<?php echo $invite[$i]['id']; ?>, 'login');" class="glyphicon glyphicon-log-in" style="color: green; font-size: 18px; cursor: pointer;"></button>
                        <?php }else{ ?>
                            <button id="logoutViz<?php echo $invite[$i]['id'];?>" onclick="todo(<?php echo $invite[$i]['id']; ?>, 'logout');" class="glyphicon glyphicon-log-out" style="color: red; font-size: 18px; cursor: pointer;"></button>
                        <?php } ?>
                        <button id="loginUnViz<?php echo $invite[$i]['id'];?>" onclick="todo(<?php echo $invite[$i]['id']; ?>, 'login');" class="glyphicon glyphicon-log-in" style="color: green; font-size: 18px; cursor: pointer; display: none;"></button>
                        <button id="logoutUnViz<?php echo $invite[$i]['id'];?>" onclick="todo(<?php echo $invite[$i]['id']; ?>, 'logout');" class="glyphicon glyphicon-log-out" style="color: red; font-size: 18px; cursor: pointer; display: none;"></button>
                        <span id="wait<?php echo $invite[$i]['id'];?>" style="display: none;">منتظر بمانید...</span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } ?>


<script>
    function todo($id, $act) {
        $('#wait' + $id).show();
        $('#logoutViz' + $id).hide();
        $('#logoutUnViz' + $id).hide();
        $('#loginUnViz' + $id).hide();
        $('#loginVis' + $id).hide();
        var i = 1;
        if(i > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "home/ajax_invite",
                cache: false,
                data: {inID: $id, inAct: $act}
            }).done(function(Data){
                $('#wait' + $id).hide();
                if (Data == 1)
                {
                    if ($act == 'login')
                    {
                        $('#logoutUnViz' + $id).show();
                    }
                    else
                    {
                        $('#loginUnViz' + $id).show();
                    }
                }
            }).fail(function() {
                $('#wait' + $id).hide();
                alert('خطایی رخ داده است.');
            });
            i--;
        }
    }
</script>
