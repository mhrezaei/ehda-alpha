<?php if (count($invite)){ ?>
<style>
    body{
/*        background: url("*/<?php //asset_url(); ?>/*images/bgg.jpg") !important;*/
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
            </tr>
        </thead>
        <tbody id="lotteryID">
            <?php for ($i = 0, $a = 1; $i < count($invite); $i++){ ?>
                <tr>
                    <th><?php echo pd($a++); ?></th>
                    <td><?php echo $invite[$i]['name']; ?></td>
                    <td id="lottery<?php echo $invite[$i]['id'];?>"><?php echo pd($invite[$i]['lottery']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } ?>


<script>
    $(document).ready(function () {
        todo();
    });
    function todo() {
        $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "home/ajax_lottery_list",
            cache: false
        }).done(function(Data){
            if (Data.count > 0)
            {
                var code = '';
                for(var i = 0; i < Data.count; i++)
                {
                    code += '<tr>';
                    code += '<th>' + Data.lottory[i].row + '</th>';
                    code += '<td>' + Data.lottory[i].name + '</td>';
                    code += '<td>' + Data.lottory[i].lottery + '</td>';
                    code += '</tr>';
                }
            }
            $('#lotteryID').html(code);
        });
        setTimeout(function(){ todo(); }, 1000);
    }
</script>
