<?php if (count($invite)){ ?>
<style>
    body{
        background: white !important;
    }
</style>
    <div style="width: 80%; font-size: 36px; font-weight: 900; text-align: center; margin: 0 auto; font-family: 'IRANSans', 'Tahoma'; margin-top: 30px; margin-bottom: 30px;">انجمن اهدای عضو ایرانیان</div>
    <div style="width: 80%; font-size: 30px; font-weight: 800; text-align: center; margin: 0 auto; font-family: 'IRANSans', 'Tahoma'; margin-top: 30px; margin-bottom: 30px;">رای گیری</div>
    <table class="table table-bordered table-responsive table-striped table-hover" style="font-family: 'IRANSans', 'Tahoma'; font-size: 24px; width: 70%; margin: 0 auto;">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>نام کاندید</th>
                <th>تعداد آرا</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0, $a = 1; $i < count($invite); $i++){ ?>
                <tr>
                    <th><?php echo pd($a++); ?></th>
                    <td><?php echo $invite[$i]['name']; ?></td>
                    <td id="lottery<?php echo $invite[$i]['id'];?>"><?php echo pd($invite[$i]['lottery']) ?></td>
                    <td>
                        <button id="add<?php echo $invite[$i]['id'];?>" onclick="todo(<?php echo $invite[$i]['id']; ?>, 'add');" class="glyphicon glyphicon-plus" style="color: green; font-size: 18px; cursor: pointer;"></button>
                        <button id="remove<?php echo $invite[$i]['id'];?>" onclick="todo(<?php echo $invite[$i]['id']; ?>, 'remove');" class="glyphicon glyphicon-minus" style="color: red; font-size: 18px; cursor: pointer;"></button>
                        <span id="wait<?php echo $invite[$i]['id'];?>" style="display: none; font-size: 14px;">منتظر بمانید...</span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } ?>


<script>
    function todo($id, $act) {
        $('#wait' + $id).show();
        $('#add' + $id).hide();
        $('#remove' + $id).hide();
        var i = 1;
        if(i > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "home/ajax_lottery",
                cache: false,
                data: {inID: $id, inAct: $act}
            }).done(function(Data){
                $('#wait' + $id).hide();
                $('#add' + $id).show();
                $('#remove' + $id).show();
                if (Data.status == 1)
                {
                    $('#lottery' + $id).text(Data.lottery);
                }
                else
                {
                    alert('خطایی رخ داده است.');
                }
            }).fail(function() {
                $('#wait' + $id).hide();
                $('#add' + $id).show();
                $('#remove' + $id).show();
                alert('خطایی رخ داده است.');
            });
            i--;
        }
    }
</script>
