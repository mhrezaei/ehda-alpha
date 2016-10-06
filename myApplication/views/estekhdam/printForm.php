<style rel="stylesheet" type="text/css">
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background: #ffffff !important;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 00mm;
        margin: 10mm auto;
        border: 0px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>

    <div class="book" style="padding: 30px; font-family: 'BNazanin', Tahoma; font-size: 18px;">
        نام: <span style="color: #265A88;"><?php echo $forms['name']; ?></span><br>
        سن: <span style="color: #265A88;"><?php echo $forms['age']; ?></span><br>
        وضعیت تاهل: <span style="color: #265A88;"><?php if($forms['mar'] == 1){echo 'مجرد';}else{echo 'متاهل';} ?></span><br>
        مدرک تحصیلی: <span style="color: #265A88;"><?php echo $forms['edu']; ?></span><br>
        رشته تحصیلی: <span style="color: #265A88;"><?php echo $forms['eduType']; ?></span><br>
        شغل کنونی: <span style="color: #265A88;"><?php echo $forms['nJob']; ?></span><br>
        تفن همراه: <span style="color: #265A88;"><?php echo $forms['mobile']; ?></span><br>
        تلفن ثابت: <span style="color: #265A88;"><?php echo $forms['tel']; ?></span><br>
        آدرس محل سکونت: <span style="color: #265A88;"><?php echo $forms['address']; ?></span><br>
        نام و آدرس محل کار فعلی: <span style="color: #265A88;"><?php echo $forms['aJob']; ?></span><br>
        تلفن محل کار فعلی: <span style="color: #265A88;"><?php echo $forms['tJob']; ?></span><br>
        ایمیل: <span style="color: #265A88;"><?php echo $forms['email']; ?></span><hr style="height: 1px; background: gray;">
        سوابق شغلی: <span style="color: #265A88;"><?php echo $forms['oJob']; ?></span><hr style="height: 1px; background: gray;">
        مدارک: <span style="color: #265A88;"><?php echo $forms['doc']; ?></span><hr style="height: 1px; background: gray;">
        نحوه آشنایی: <span style="color: #265A88;"><?php echo $forms['rel']; ?></span><br>
        حقوق پیشنهادی: <span style="color: #265A88;"><?php echo $forms['pr']; ?></span><br>
    </div>