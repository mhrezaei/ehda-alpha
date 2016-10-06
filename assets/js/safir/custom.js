function submitRegisterFormSafir()
{
    var name = $("#txtRegisterFirstName");
    var family = $("#txtRegisterLastName");
    var father = $("#txtRegisterFatherName");
    var sex = $("#cbRegisterGender");
    var idNumber = $("#txtRegisterIDNumber");
    var national = $("#txtRegisterNationalCode");
    var birth = $("#cbRegisterBirthDate");
    var birthExtra = $("#txtExtraBirthday");
    var placeOfBirth = $("#txtRegisterPlaceOfBirth");
    var mob = $("#txtRegisterMobile");
    var tel = $("#txtRegisterTel");
    var st = $("#cbRegisterState");
    var ci = $("#cbRegisterCity");
    var chAll = $("#chRegisterAll");
    var chHeart = $("#chRegisterHeart");
    var chLung = $("#chRegisterLung");
    var chLiver = $("#chRegisterLiver");
    var chKindney = $("#chRegisterKidney");
    var chPancreas = $("#chRegisterPancreas");
    var chTissues = $("#chRegisterTissues");
    var progressVal = $("#progressVal");
    var progress = $(".progress");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");
    var form =  $("#registerForm");
    var btns = $("#divBtn .btn");
    var print = $("#safirPrintAgain");
    var err = 0;
    var msg = new Array;
    btns.attr('disabled', 'disabled');
    wAlert.hide();
    print.hide();

    progress.show();
    $('.has-error,  .has-success').removeClass('has-success').removeClass('has-error');

    // first name validate
    if(name.val().length < 2 || is_numeric(name.val()))
    {
        err++;
        name.parent().parent().addClass('has-error');
        msg.push('نام را به صورت صحیح وارد نمائید.');
    }
    else
    {
        name.parent().parent().addClass('has-success');
    }

    // last name validate
    if(family.val().length < 2 || is_numeric(family.val()))
    {
        err++;
        family.parent().parent().addClass('has-error');
        msg.push('نام خانوادگی را به صورت صحیح وارد نمائید.');
    }
    else
    {
        family.parent().parent().addClass('has-success');
    }

    // sex validate
    if(sex.val() < 1 || sex.val() > 2)
    {
        err++;
        sex.parent().parent().addClass('has-error');
        msg.push('جنسیت  را انتخاب نمائید.');
    }
    else
    {
        sex.parent().parent().addClass('has-success');
    }

    // father name validate
    if(father.val().length < 2 || is_numeric(father.val()))
    {
        err++;
        father.parent().parent().addClass('has-error');
        msg.push('نام پدر را به صورت صحیح وارد نمائید.');
    }
    else
    {
        father.parent().parent().addClass('has-success');
    }

    // id number validate
    var idNumberVal = convertDigitToIn(idNumber.val());
    if(idNumberVal.length < 1 || !is_numeric(idNumberVal) || idNumberVal < 1)
    {
        err++;
        idNumber.parent().parent().addClass('has-error');
        msg.push('شماره شناسنامه  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        idNumber.parent().parent().addClass('has-success');
        idNumber.val(idNumberVal);
    }

    // national code validate
    var nationalVal = convertDigitToIn(national.val());
    if(nationalVal.length != 10 || !is_numeric(nationalVal) || !nationalCodeVerify(nationalVal))
    {
        err++;
        national.parent().parent().addClass('has-error');
        msg.push('کدملی  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        national.parent().parent().addClass('has-success');
        national.val(nationalVal);
    }

    // birth date validate
    if(birth.val().length < 7 || birthExtra.val().length < 7 || birth.hasClass("invalid"))
    {
        err++;
        birth.parent().parent().addClass('has-error');
        msg.push('تاریخ تولد  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        birth.parent().parent().addClass('has-success');
    }

    // place of birth validate
    if(placeOfBirth.val().length < 2 || is_numeric(placeOfBirth.val()))
    {
        err++;
        placeOfBirth.parent().parent().addClass('has-error');
        msg.push('محل تولد  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        placeOfBirth.parent().parent().addClass('has-success');
    }

    // mobile number validate
    var mobVal = convertDigitToIn(mob.val());
    if(mobVal.length != 11 || !is_numeric(mobVal) || mobVal[0] != 0 || mobVal[1] != 9)
    {
        err++;
        mob.parent().parent().addClass('has-error');
        msg.push('شماره همراه  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        mob.parent().parent().addClass('has-success');
        mob.val(mobVal);
    }

    // phone number validate
    var telVal = convertDigitToIn(tel.val());
    if(telVal.length != 11 || !is_numeric(telVal) || telVal[0] != 0)
    {
        err++;
        tel.parent().parent().addClass('has-error');
        msg.push('شماره تلفن ثابت  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        tel.parent().parent().addClass('has-success');
        tel.val(telVal);
    }

    // state validate
    if(st.val() < 1)
    {
        err++;
        st.parent().parent().addClass('has-error');
        msg.push('استان  را انتخاب نمائید.');
    }
    else
    {
        st.parent().parent().addClass('has-success');
    }

    // city validate
    if(ci.val() < 1)
    {
        err++;
        ci.parent().parent().addClass('has-error');
        msg.push('شهر  را انتخاب نمائید.');
    }
    else
    {
        ci.parent().parent().addClass('has-success');
    }

    // organs validate
    if(chAll.is(":checked") || chHeart.is(":checked") || chKindney.is(":checked") || chLiver.is(":checked") || chLung.is(":checked") || chPancreas.is(":checked") || chTissues.is(":checked"))
    {
        $("#organCheck").parent().parent().addClass('has-success');
    }
    else
    {
        err++;
        $("#organCheck").parent().parent().addClass('has-error');
        msg.push('حداقل یکی از ارگان ها را جهت اهدا انتخاب نمائید.');
    }


    // check number of error in javascript validate
    if(err > 0)
    {
        var m = '<ul>';
        for(var i = 0; i < msg.length; i++)
        {
            m += '<li>' + msg[i] + '</li>';
        }
        m += '<ul>';
        wAlert.addClass('alert-warning');
        wAlertMsg.html(m);
        wAlert.show();
        btns.removeAttr('disabled', 'disabled');
        progress.hide();
    }
    else if(err == 0) // send data to server
    {
        progressVal.delay(1000).animate({width : "60%"}, 500);
        if(form.is('form'))
        {
            var cbRegisterGender = ($('#cbRegisterGender :selected').text());
            var cbRegisterGenderVal = ($('#cbRegisterGender :selected').val());
            var cbRegisterState = ($('#cbRegisterState :selected').text());
            var cbRegisterStateVal = ($('#cbRegisterState :selected').val());
            var cbRegisterCity = ($('#cbRegisterCity :selected').text());
            var cbRegisterCityVal = ($('#cbRegisterCity :selected').val());

            var data = form.serialize();

            $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                var input = $(this);
                input.prop('disabled', true).attr("disabled", true);
                $(".pcalBtn").hide();
                if(input.is(":checkbox")) {
                    input.addClass('disabled').parent().prop('disabled', true).attr("disabled", true);
                }
            });

            // ajax
            var i = 1;
            if(i > 0)
            {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: base_url() + "ajax/processing/safirNewRegister",
                    cache: false,
                    data: data
                }).done(function(Data){
                    if(Data.status == 1) // validate nad register in server is done
                    {
                        progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
                        progress.hide();
                        $("form#registerForm :input[type=text], form#registerForm :input[type=email], form#registerForm :input[type=password], form#registerForm select").each(function(){
                            var input = $(this);
                            input.prop('disabled', false).removeAttr("disabled", false);
                            $(".pcalBtn").show();
                            if(input.is(":checkbox")) {
                                input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                            }
                            document.registerForm.reset();
                            $("#cbRegisterState").val(8);
                            selectCity();
                            $("#cbRegisterCity").val(135);
                        });

                        var html = 'ثبت نام با موفقیت انجام گردید.';
                        wAlertMsg.html(html)
                        wAlert.removeClass('alert-warning').addClass('alert-success').show();
                        btns.attr('disabled', false).prop('disabled', false);
                        setTimeout(function(){location.reload();}, 3000);
                    }
                    else if(Data.status == 0) // validate in server fail
                    {
                        progress.hide();
                        btns.attr('disabled', false).prop('disabled', false);
                        sex.val(cbRegisterGenderVal);
                        st.val(cbRegisterStateVal);
                        ci.val(cbRegisterCityVal);
                        $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                            var input = $(this);
                            input.prop('disabled', false).removeAttr("disabled", false);
                            $(".pcalBtn").show();
                            if(input.is(":checkbox")) {
                                input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                            }
                            input.val(convertDigitToIn(input.val()));
                        });
                        wAlertMsg.text('');
                        for(var i = 0; i < Data.data.length; i++)
                        {
                            $(Data.data[i].id).parent().parent().addClass('has-error');
                            wAlertMsg.append(Data.data[i].msg + '<br>');
                        }
                        wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                    }
                    else if(Data.status == -1) // national code already used
                    {
                        progress.hide();
                        print.show();
                        wAlertMsg.html('این کد ملی قبلا ثبت شده است، می توانید با استفاده از دکمه چاپ مجدد دوباره آن را برای چاپ ارسال نمائید.');
                        wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                        btns.attr('disabled', false).prop('disabled', false);
                        sex.val(cbRegisterGenderVal);
                        st.val(cbRegisterStateVal);
                        ci.val(cbRegisterCityVal);
                        $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                            var input = $(this);
                            input.prop('disabled', false).removeAttr("disabled", false);
                            $(".pcalBtn").show();
                            if(input.is(":checkbox")) {
                                input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                            }
                            input.val(convertDigitToIn(input.val()));
                        });
                    }
                    else if(Data.status == 2 || Data.status == 3 || Data.status == 4) // failed to insert data
                    {
                        progress.hide();
                        $("form#registerForm :input[type=text], form#registerForm :input[type=email], form#registerForm :input[type=password], form#registerForm select").each(function(){
                            var input = $(this);
                            input.prop('disabled', false).removeAttr("disabled", false);
                            $(".pcalBtn").show();
                            if(input.is(":checkbox")) {
                                input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                            }
                        });

                        var html = 'خطای سیستمی رخ داده است، لطفاً به مدیر سایت اطلاع دهید.';
                        wAlertMsg.html(html)
                        wAlert.removeClass('alert-success').addClass('alert-warning').show();
                        btns.attr('disabled', false).prop('disabled', false);
                    }
                    else // validate problem
                    {
                        alert('خطای سیستمی رخ داده است، لطفا دوباره سعی نمائید.');
                        window.location = base_url() + 'safir/register';
                    }
                }).fail(function() {
                    progress.hide();
                    wAlertMsg.html('خطای سیستمی رخ داده است، مجدداً تلاش نمائید.');
                    wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                    btns.attr('disabled', false).prop('disabled', false);
                    sex.val(cbRegisterGenderVal);
                    st.val(cbRegisterStateVal);
                    ci.val(cbRegisterCityVal);
                    $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                        var input = $(this);
                        input.prop('disabled', false).removeAttr("disabled", false);
                        $(".pcalBtn").show();
                        if(input.is(":checkbox")) {
                            input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                        }
                        input.val(convertDigitToIn(input.val()));
                    });
                });
                i--;

                // when click on print again btn
                print.unbind('click').bind('click', function(){
                    sex.val(cbRegisterGenderVal);
                    st.val(cbRegisterStateVal);
                    ci.val(cbRegisterCityVal);
                    $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                        var input = $(this);
                        input.prop('disabled', true).removeAttr("disabled", true);
                        if(input.is(":checkbox")) {
                            input.addClass('disabled').parent().prop('disabled', true).removeAttr("disabled", true);
                        }
                    });
                    printAgainByNationalCode(nationalVal);
                });

            }
        }
    }

    return false; // for safety
}

function submitEditFormSafir(status)
{
    var name = $("#txtRegisterFirstName");
    var family = $("#txtRegisterLastName");
    var father = $("#txtRegisterFatherName");
    var sex = $("#cbRegisterGender");
    var idNumber = $("#txtRegisterIDNumber");
    var birth = $("#cbRegisterBirthDate");
    var birthExtra = $("#txtExtraBirthday");
    var placeOfBirth = $("#txtRegisterPlaceOfBirth");
    var mob = $("#txtRegisterMobile");
    var tel = $("#txtRegisterTel");
    var st = $("#cbRegisterState");
    var ci = $("#cbRegisterCity");
    var txtPrint = $("#txtPrint");
    var form =  $("#registerForm");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");

    var err = 0;
    var msg = new Array;

    // first name validate
    if(name.val().length < 2 || is_numeric(name.val()))
    {
        err++;
        name.parent().parent().addClass('has-error');
        msg.push('نام را به صورت صحیح وارد نمائید.');
    }
    else
    {
        name.parent().parent().addClass('has-success');
    }

    // last name validate
    if(family.val().length < 2 || is_numeric(family.val()))
    {
        err++;
        family.parent().parent().addClass('has-error');
        msg.push('نام خانوادگی را به صورت صحیح وارد نمائید.');
    }
    else
    {
        family.parent().parent().addClass('has-success');
    }

    // sex validate
    if(sex.val() < 1 || sex.val() > 2)
    {
        err++;
        sex.parent().parent().addClass('has-error');
        msg.push('جنسیت  را انتخاب نمائید.');
    }
    else
    {
        sex.parent().parent().addClass('has-success');
    }

    // father name validate
    if(father.val().length < 2 || is_numeric(father.val()))
    {
        err++;
        father.parent().parent().addClass('has-error');
        msg.push('نام پدر را به صورت صحیح وارد نمائید.');
    }
    else
    {
        father.parent().parent().addClass('has-success');
    }

    // id number validate
    var idNumberVal = convertDigitToIn(idNumber.val());
    if(idNumberVal.length < 1 || !is_numeric(idNumberVal) || idNumberVal < 1)
    {
        err++;
        idNumber.parent().parent().addClass('has-error');
        msg.push('شماره شناسنامه  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        idNumber.parent().parent().addClass('has-success');
        idNumber.val(idNumberVal);
    }

    // birth date validate
    if(birth.val().length < 7 || birthExtra.val().length < 7 || birth.hasClass("invalid"))
    {
        err++;
        birth.parent().parent().addClass('has-error');
        msg.push('تاریخ تولد  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        birth.parent().parent().addClass('has-success');
    }

    // place of birth validate
    if(placeOfBirth.val().length < 2 || is_numeric(placeOfBirth.val()))
    {
        err++;
        placeOfBirth.parent().parent().addClass('has-error');
        msg.push('محل تولد  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        placeOfBirth.parent().parent().addClass('has-success');
    }

    // mobile number validate
    var mobVal = convertDigitToIn(mob.val());
    if(mobVal.length != 11 || !is_numeric(mobVal) || mobVal[0] != 0 || mobVal[1] != 9)
    {
        err++;
        mob.parent().parent().addClass('has-error');
        msg.push('شماره همراه  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        mob.parent().parent().addClass('has-success');
        mob.val(mobVal);
    }

    // phone number validate
    var telVal = convertDigitToIn(tel.val());
    if(telVal.length != 11 || !is_numeric(telVal) || telVal[0] != 0)
    {
        err++;
        tel.parent().parent().addClass('has-error');
        msg.push('شماره تلفن ثابت  را به صورت صحیح وارد نمائید.');
    }
    else
    {
        tel.parent().parent().addClass('has-success');
        tel.val(telVal);
    }

    // state validate
    if(st.val() < 1)
    {
        err++;
        st.parent().parent().addClass('has-error');
        msg.push('استان  را انتخاب نمائید.');
    }
    else
    {
        st.parent().parent().addClass('has-success');
    }

    // city validate
    if(ci.val() < 1)
    {
        err++;
        ci.parent().parent().addClass('has-error');
        msg.push('شهر  را انتخاب نمائید.');
    }
    else
    {
        ci.parent().parent().addClass('has-success');
    }


    // check number of error in javascript validate
    if(err > 0)
    {
        var m = '<ul>';
        for(var i = 0; i < msg.length; i++)
        {
            m += '<li>' + msg[i] + '</li>';
        }
        m += '<ul>';
        wAlert.addClass('alert-warning');
        wAlertMsg.html(m);
        wAlert.show();
    }
    else if(err == 0) // send data to server
    {
        txtPrint.val(status);
        if (status == 3)
        {
            if (confirm('آیا از حذف این کارت اطمینان دارید؟'))
            {
                document.registerForm.submit();
            }
        }
        else
        {
            document.registerForm.submit();
        }
    }

    return false; // for safety
}

function printAgainByNationalCode(national)
{
    var progressVal = $("#progressVal");
    var progress = $(".progress");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");
    var form =  $("#registerForm");
    var btns = $("#divBtn .btn");
    var print = $("#safirPrintAgain");
    var err = 0;
    var msg = new Array;
    btns.attr('disabled', 'disabled');
    wAlert.hide();
    progressVal.delay(1000).animate({width : "60%"}, 500).delay(1000);
    progress.show();
    var i = 1;
    if(i > 0)
    {
        $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "ajax/processing/safirPrintAgainUser",
            cache: false,
            data: {national: national}
        }).done(function(Data){
            if(Data.status == 1) // status chnage
            {
                progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
                progress.hide();
                print.hide();
                $("form#registerForm :input[type=text], form#registerForm :input[type=email], form#registerForm :input[type=password], form#registerForm select").each(function(){
                    var input = $(this);
                    input.prop('disabled', false).removeAttr("disabled", false);
                    $(".pcalBtn").show();
                    if(input.is(":checkbox")) {
                        input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                    }
                    document.registerForm.reset();
                    $("#cbRegisterState").val(8);
                    selectCity();
                    $("#cbRegisterCity").val(135);
                });

                var html = 'کارت مورد نظر با موفقیت در صف چاپ قرار گرفت.';
                wAlertMsg.html(html);
                wAlert.removeClass('alert-warning').addClass('alert-success').show();
                btns.attr('disabled', false).prop('disabled', false);
            }
            else if(Data.status == -1) // user not found
            {
                progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
                progress.hide();
                print.hide();
                $("form#registerForm :input[type=text], form#registerForm :input[type=email], form#registerForm :input[type=password], form#registerForm select").each(function(){
                    var input = $(this);
                    input.prop('disabled', false).removeAttr("disabled", false);
                    $(".pcalBtn").show();
                    if(input.is(":checkbox")) {
                        input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                    }
                    document.registerForm.reset();
                    $("#cbRegisterState").val(8);
                    selectCity();
                    $("#cbRegisterCity").val(135);
                });

                var html = 'کاربر مورد نظر یافت نشد، دوباره سعی نمائید.';
                wAlertMsg.html(html);
                wAlert.removeClass('alert-success').addClass('alert-warning').show();
                btns.attr('disabled', false).prop('disabled', false);
            }
            else
            {
                progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
                progress.hide();
                print.hide();
                $("form#registerForm :input[type=text], form#registerForm :input[type=email], form#registerForm :input[type=password], form#registerForm select").each(function(){
                    var input = $(this);
                    input.prop('disabled', false).removeAttr("disabled", false);
                    $(".pcalBtn").show();
                    if(input.is(":checkbox")) {
                        input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                    }
                    document.registerForm.reset();
                    $("#cbRegisterState").val(8);
                    selectCity();
                    $("#cbRegisterCity").val(135);
                });

                var html = 'خطای سیستمی رخ داده است، دوباره سعی نمایید.';
                wAlertMsg.html(html);
                wAlert.removeClass('alert-success').addClass('alert-warning').show();
                btns.attr('disabled', false).prop('disabled', false);
            }
        }).fail(function() {
            progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
            progress.hide();
            print.hide();
            $("form#registerForm :input[type=text], form#registerForm :input[type=email], form#registerForm :input[type=password], form#registerForm select").each(function(){
                var input = $(this);
                input.prop('disabled', false).removeAttr("disabled", false);
                $(".pcalBtn").show();
                if(input.is(":checkbox")) {
                    input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                }
                document.registerForm.reset();
                $("#cbRegisterState").val(8);
                selectCity();
                $("#cbRegisterCity").val(135);
            });

            var html = 'خطای سیستمی رخ داده است، دوباره سعی نمایید.';
            wAlertMsg.html(html);
            wAlert.removeClass('alert-success').addClass('alert-warning').show();
            btns.attr('disabled', false).prop('disabled', false);
        });
        i--;
    }
}