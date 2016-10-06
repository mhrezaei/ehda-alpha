//function base_url(ext)
//{
//    var url     = window.location.href,
//    base    = url.substring(0, url.indexOf('/', 14)),
//    ret_url = base + "/card/";
//    //        ret_url = base + "/";
//
//    if(ext !== undefined && ext !== '') {
//        ret_url += ext;
//    }
//
//    return ret_url;
//}

function changeUrl(url)
{
    window.location = base_url() + url;
}

function is_numeric(mixed_var)
{
    var whitespace =
        " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    return (typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
            1)) && mixed_var !== '' && !isNaN(mixed_var);
}

function checkEmail(email)
{

    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,8})+$/;

    if(!filter.test(email))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function convertDigitToIn(perDigit)
{
    var newValue="";
    for (var i=0;i<perDigit.length;i++)
    {
        var ch=perDigit.charCodeAt(i);
        if (ch>=1776 && ch<=1785) // For Persian digits.
        {
            var newChar=ch-1728;
            newValue=newValue+String.fromCharCode(newChar);
        }
        else if(ch>=1632 && ch<=1641) // For Arabic & Unix digits.
        {
            var newChar=ch-1584;
            newValue=newValue+String.fromCharCode(newChar);
        }
        else
            newValue=newValue+String.fromCharCode(ch);
    }
    return newValue;
}

function convertDigitToPer(enDigit)
{
    var newValue="";
    for (var i=0;i<enDigit.length;i++)
    {
        var ch=enDigit.charCodeAt(i);
        if (ch>=48 && ch<=57)
        {
            var newChar=ch+1584;
            newValue=newValue+String.fromCharCode(newChar);
        }
        else
        {
            newValue = newValue + String.fromCharCode(ch);
        }
    }
    return newValue;
}

function nationalCodeVerify(code)
{

    if(code.length == 10 && !isNaN(code))
    {
        var code = code.split("");
        var err ;
        for(var i = 0; i < code.length; i++)
        {
            if(code[0] > code[i] || code[0] < code[i])
            {
                err = 1;
                break;
            }
            else
            {
                err = 2;
            }
        }

        if(err == 1)
        {
            var valid = 0;
            var jumper = 10;
            for(var i = 0; i <= 8; i++)
            {
                valid += code[i] * jumper;
                --jumper;
            }
            valid = valid % 11;
            if(valid >= 0 && valid < 2)
            {
                if(valid == code['9'])
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                valid = 11 - valid;
                if(valid == code['9'])
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

function loginFormTog()
{
    $('#loginRegisterBtn').toggle("fast", function(){
        $('#ehdaCardContent').toggle("fast");
        $('#loginForm').slideToggle("fast");
    });
}

function selectCity()
{
    var ci = '<option value="0">انتخاب کنید...</option>';
    var selectSt = $('#cbRegisterState');
    var selectCi = $('#cbRegisterCity');
    selectCi.html(ci);
    var city = window['city'];
    //console.log(city);
    if(selectSt.val() > 0 && selectSt.val() < 32)
    {
        city = city[selectSt.val()];
        for(var c in city)
        {
            ci += '<option value="' + city[c].id + '">' + city[c].name + '</option>';
        }
        selectCi.html(ci);
    }
}

function selectEditCity(id)
{
    var ci = '<option value="0">انتخاب کنید...</option>';
    var selectSt = $('#cbRegisterState');
    var selectCi = $('#cbRegisterCity');
    selectCi.html(ci);
    var city = window['city'];
    //console.log(city);
    if(selectSt.val() > 0 && selectSt.val() < 32)
    {
        city = city[selectSt.val()];
        for(var c in city)
        {
            if(city[c].id == id)
            {
                ci += '<option value="' + city[c].id + '" selected="selected">' + city[c].name + '</option>';
            }
            else
            {
                ci += '<option value="' + city[c].id + '">' + city[c].name + '</option>';
            }
        }
        selectCi.html(ci);
    }
}

function submitRegisterForm()
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
    var edu = $("#cbRegisterEducation");
    var job = $("#txtRegisterJob");
    var mob = $("#txtRegisterMobile");
    var tel = $("#txtRegisterTel");
    var st = $("#cbRegisterState");
    var ci = $("#cbRegisterCity");
    var email = $("#txtRegisterEmail");
    var user = $("#txtRegisterUsername");
    var pass = $("#txtRegisterPassword");
    var vPass = $("#txtRegisterVerifyPassword");
    var chAll = $("#chRegisterAll");
    var chHeart = $("#chRegisterHeart");
    var chLung = $("#chRegisterLung");
    var chLiver = $("#chRegisterLiver");
    var chKindney = $("#chRegisterKidney");
    var chPancreas = $("#chRegisterPancreas");
    var chTissues = $("#chRegisterTissues");
    var dbCheck = $("#txtDbCheck");
    var progressVal = $("#progressVal");
    var progress = $(".progress");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");
    var form =  $("#registerForm");
    var btns = $("#divBtn .btn");
    var verifyBtn = $("#dbCheckVerifyBtn");
    var dbCheckEditBtn = $("#dbCheckEditBtn");
    var dbCheckBtn = $("#dbCheckBtn");
    var err = 0;
    var msg = new Array;
    btns.attr('disabled', 'disabled');
    wAlert.hide();
    dbCheck.val('0');

    progress.show();
    $('.has-error,  .has-success').removeClass('has-success').removeClass('has-error');

    // first name validate
    if(name.val().length < 2 || is_numeric(name.val()))
    {
        err++;
        name.parent().addClass('has-error');
        msg.push('نام را به صورت صحیح وارد نمائید.');
    }
    else
    {
        name.parent().addClass('has-success');
    }

    // last name validate
    if(family.val().length < 2 || is_numeric(family.val()))
    {
        err++;
        family.parent().addClass('has-error');
        msg.push('نام خانوادگی را به صورت صحیح وارد نمائید.');
    }
    else
    {
        family.parent().addClass('has-success');
    }

    // sex validate
    if(sex.val() < 1 || sex.val() > 2)
    {
        err++;
        sex.parent().addClass('has-error');
        msg.push('جنسیت خود را انتخاب نمائید.');
    }
    else
    {
        sex.parent().addClass('has-success');
    }

    // father name validate
    if(father.val().length < 2 || is_numeric(father.val()))
    {
        err++;
        father.parent().addClass('has-error');
        msg.push('نام پدر را به صورت صحیح وارد نمائید.');
    }
    else
    {
        father.parent().addClass('has-success');
    }

    // id number validate
    var idNumberVal = convertDigitToIn(idNumber.val());
    if(idNumberVal.length < 1 || !is_numeric(idNumberVal) || idNumberVal < 1)
    {
        err++;
        idNumber.parent().addClass('has-error');
        msg.push('شماره شناسنامه خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        idNumber.parent().addClass('has-success');
        idNumber.val(convertDigitToPer(idNumberVal));
    }

    // national code validate
    var nationalVal = convertDigitToIn(national.val());
    if(nationalVal.length != 10 || !is_numeric(nationalVal) || !nationalCodeVerify(nationalVal))
    {
        err++;
        national.parent().addClass('has-error');
        msg.push('کدملی خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        national.parent().addClass('has-success');
        national.val(convertDigitToPer(nationalVal));
    }

    // birth date validate
    if(birth.val().length < 7 || birthExtra.val().length < 7 || birth.hasClass("invalid"))
    {
        err++;
        birth.parent().addClass('has-error');
        msg.push('تاریخ تولد خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        birth.parent().addClass('has-success');
        birth.val(convertDigitToPer(birth.val()));
    }

    // place of birth validate
    if(placeOfBirth.val().length < 2 || is_numeric(placeOfBirth.val()))
    {
        err++;
        placeOfBirth.parent().addClass('has-error');
        msg.push('محل تولد خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        placeOfBirth.parent().addClass('has-success');
    }

    // mobile number validate
    var mobVal = convertDigitToIn(mob.val());
    if(mobVal.length != 11 || !is_numeric(mobVal) || mobVal[0] != 0 || mobVal[1] != 9)
    {
        err++;
        mob.parent().addClass('has-error');
        msg.push('شماره همراه خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        mob.parent().addClass('has-success');
        mob.val(convertDigitToPer(mob.val()));
    }

    // phone number validate
    var telVal = convertDigitToIn(tel.val());
    if(telVal.length != 11 || !is_numeric(telVal) || telVal[0] != 0)
    {
        err++;
        tel.parent().addClass('has-error');
        msg.push('شماره تلفن ثابت خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        tel.parent().addClass('has-success');
        tel.val(convertDigitToPer(tel.val()));
    }

    // state validate
    if(st.val() < 1)
    {
        err++;
        st.parent().addClass('has-error');
        msg.push('استان خود را انتخاب نمائید.');
    }
    else
    {
        st.parent().addClass('has-success');
    }

    // city validate
    if(ci.val() < 1)
    {
        err++;
        ci.parent().addClass('has-error');
        msg.push('شهر خود را انتخاب نمائید.');
    }
    else
    {
        ci.parent().addClass('has-success');
    }

    // email if user entered validate
    var emailVal = convertDigitToIn(email.val());
    if(emailVal.length > 0)
    {
        if(!checkEmail(emailVal))
        {
            err++;
            email.parent().addClass('has-error');
            msg.push('ایمیل خود را به صورت صحیح وارد نمائید.');
        }
        else
        {
            email.parent().addClass('has-success');
            email.val(emailVal);
        }
    }

    // username validate
    var usernameVal = convertDigitToIn(user.val());
    if(!/^[A-Za-z0-9_\-\.]{6,32}$/.test(usernameVal))
    {
        err++;
        user.parent().addClass('has-error');
        msg.push('نام کاربری خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        user.parent().addClass('has-success');
        user.val(usernameVal);
    }

    // password and verify password validate
    var passVal = convertDigitToIn(pass.val());
    var vPassVal = convertDigitToIn(vPass.val());
    if(!/^[A-Za-z0-9!@#$%^&*()_\-\.]{6,32}$/.test(passVal))
    {
        err++;
        pass.parent().addClass('has-error');
        msg.push('رمز عبور را به صورت صحیح وارد نمائید.');
    }
    else
    {
        pass.parent().addClass('has-success');
        pass.val(passVal);
    }

    // password and verify password validate
    if(passVal != vPassVal || vPassVal.length < 6)
    {
        err++;
        vPass.parent().addClass('has-error');
        pass.parent().addClass('has-error');
        msg.push('رمز عبور با تکرار آن مطابقت ندارد.');
    }
    else
    {
        vPass.parent().addClass('has-success');
        pass.parent().addClass('has-success');
        vPass.val(vPassVal);
    }

    // organs validate
    if(chAll.is(":checked") || chHeart.is(":checked") || chKindney.is(":checked") || chLiver.is(":checked") || chLung.is(":checked") || chPancreas.is(":checked") || chTissues.is(":checked"))
    {
        $("#organCheck").parent().addClass('has-success');
    }
    else
    {
        err++;
        $("#organCheck").parent().addClass('has-error');
        msg.push('حداقل یکی از ارگان ها را جهت اهدا انتخاب نمائید.');
    }

    // convert birth date to english number when user try to edit that
    birth.on('focus', function(){
        birth.val(convertDigitToIn(birth.val()));
    });


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
        progressVal.delay(1000).animate({width : "40%"}, 500);
        if(form.is('form'))
        {
            var cbRegisterGender = ($('#cbRegisterGender :selected').text());
            var cbRegisterGenderVal = ($('#cbRegisterGender :selected').val());
            var cbRegisterEducation = ($('#cbRegisterEducation :selected').text());
            var cbRegisterEducationVal = ($('#cbRegisterEducation :selected').val());
            var cbRegisterState = ($('#cbRegisterState :selected').text());
            var cbRegisterStateVal = ($('#cbRegisterState :selected').val());
            var cbRegisterCity = ($('#cbRegisterCity :selected').text());
            var cbRegisterCityVal = ($('#cbRegisterCity :selected').val());
            $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                var input = $(this);
                input.val(convertDigitToIn(input.val()));
            });

            var data = form.serialize();
            
            $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                var input = $(this);
                input.val(convertDigitToPer(input.val()));
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
                    url: base_url() + "ajax/processing/newUserRegister",
                    cache: false,
                    data: data
                }).done(function(Data){
                    if(Data.status == 1) // validate in server is done
                    {
                        progressVal.delay(1000).animate({width : "60%"}, 500).delay(1000);
                        progress.hide();
                        dbCheck.val(Data.key);
                        $('.formRequired').hide();
                        $("form#registerForm :input[type=text], form#registerForm :input[type=email], form#registerForm :input[type=password], form#registerForm select").each(function(){
                                var input = $(this);
                                if(input.is(':input[type=password]'))
                                {
                                    input.hide('fast');
                                    input.after('<div class="dbCheckInput" style="padding-top: 7px;">[رمز انتخابی شما]</div>');
                                }
                                else if(input.is('select'))
                                {
                                    input.hide('fast');
                                    var x = input.attr('id');
                                    x == 'cbRegisterGender' ? x = cbRegisterGender : x = x;
                                    x == 'cbRegisterEducation' ? x = cbRegisterEducation : x = x;
                                    x == 'cbRegisterState' ? x = cbRegisterState : x = x;
                                    x == 'cbRegisterCity' ? x = cbRegisterCity : x = x;
                                    input.after('<div class="dbCheckInput" style="padding-top: 7px;">' + x + '</div>');
                                }
                                else
                                {
                                    input.hide('fast');
                                    input.after('<div class="dbCheckInput" style="padding-top: 7px;">' + input.val() + '</div>');
                                }
                            });

                        // display organs
                        if(chAll.is(':checked'))
                        {
                            $('#btnGroup').hide().after('<div class="dbCheckInput" style="padding-top: 7px;">همه اعضا و نسوج قابل اهدا</div>');
                        }
                        else
                        {
                            var organ = new Array;
                            if(chHeart.is(':checked'))
                            {
                                organ.push('قلب');
                            }

                            if(chKindney.is(':checked'))
                            {
                                organ.push('کلیه');
                            }

                            if(chLiver.is(':checked'))
                            {
                                organ.push('کبد');
                            }

                            if(chLung.is(':checked'))
                            {
                                organ.push('ریه');
                            }

                            if(chPancreas.is(':checked'))
                            {
                                organ.push('پانکراس');
                            }

                            if(chTissues.is(':checked'))
                            {
                                organ.push('نسوج');
                            }

                            if(organ.length > 0)
                            {
                                var organs = '';
                                for(var i = 0; i < organ.length; i++)
                                {
                                    if(i < (organ.length - 1))
                                    {
                                        organs += organ[i] + '، ';
                                    }
                                    else
                                    {
                                        organs += organ[i];
                                    }
                                }
                                $('#btnGroup').hide().after('<div class="dbCheckInput" style="padding-top: 7px;">'+ organs + '</div>');
                            }
                        }

                        var html = 'همیار گرامی؛' + '<br>' + 'مراحل ثبت نام شما رو به اتمام است، لطفا بار دیگر اطلاعات خود را بازبینی نموده و در صورت تایید برروی دکمه تایید اطلاعات کلیک نمائید.';
                        wAlertMsg.html(html)
                        wAlert.removeClass('alert-warning').addClass('alert-info').show();
                        btns.hide();
                        dbCheckBtn.show();
                    }
                    else if(Data.status < 1) // validate in server fail
                    {
                        progress.hide();
                        btns.attr('disabled', false).prop('disabled', false);
                        sex.val(cbRegisterGenderVal);
                        edu.val(cbRegisterEducationVal);
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
                            $(Data.data[i].id).parent().addClass('has-error');
                            wAlertMsg.append(Data.data[i].msg + '<br>');
                        }
                        wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                    }
                    else // validate problem
                    {
                        alert('خطای سیستمی رخ داده است، لطفا دوباره سعی نمائید.');
                        window.location = base_url() + 'home/register';
                    }
                }).fail(function() {
                    progress.hide();
                    wAlertMsg.html('خطای سیستمی رخ داده است، مجدداً تلاش نمائید.')
                    wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                    btns.attr('disabled', false).prop('disabled', false);
                    sex.val(cbRegisterGenderVal);
                    edu.val(cbRegisterEducationVal);
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

                // edit data after once validate
                dbCheckEditBtn.unbind('click').bind('click', function(){
                    btns.attr('disabled', false).prop('disabled', false);
                    dbCheckBtn.hide('fast', function(){
                        btns.show();
                    });
                    wAlert.removeClass('alert-info').hide();
                    $('.formRequired').show();
                    $('#btnGroup').show();
                    sex.val(cbRegisterGenderVal);
                    edu.val(cbRegisterEducationVal);
                    st.val(cbRegisterStateVal);
                    ci.val(cbRegisterCityVal);
                    $(".dbCheckInput").hide('fast', function(){
                        $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                            var input = $(this);
                            input.prop('disabled', false).removeAttr("disabled", false);
                            $(".pcalBtn").show();
                            if(input.is(":checkbox")) {
                                input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                            }
                            input.show();
                            input.val(convertDigitToIn(input.val()));
                        });
                    });
                });

                // when click on verify data for register after validation
                verifyBtn.unbind('click').bind('click', function(){
                    sex.val(cbRegisterGenderVal);
                    edu.val(cbRegisterEducationVal);
                    st.val(cbRegisterStateVal);
                    ci.val(cbRegisterCityVal);
                    $("form#registerForm :input, form#registerForm select, form#registerForm :checkbox").each(function(){
                        var input = $(this);
                        input.prop('disabled', false).removeAttr("disabled", false);
                        if(input.is(":checkbox")) {
                            input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                        }
                        input.val(convertDigitToIn(input.val()));
                    });

                    var data = form.serialize();
                    registerUser(data);
                });

            }
        }
    }

    return false; // for safety
}

// function register user after validation
function registerUser(data)
{
    var progressVal = $("#progressVal");
    var progress = $(".progress");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");
    var form =  $("#registerForm");
    var verifyBtn = $("#dbCheckVerifyBtn");
    var dbCheckEditBtn = $("#dbCheckEditBtn");
    var dbCheckBtn = $("#dbCheckBtn");
    var err = 0;
    var msg = new Array;
    wAlert.hide();
    progress.show();
    $("#dbCheckBtn .btn").prop('disabled', true).attr('disabled', true);
    progressVal.delay(1000).animate({width : "80%"}, 500).delay(1000);
    $.ajax({
        dataType: "json",
        type: "POST",
        url: base_url() + "ajax/processing/newUserRegister",
        cache: false,
        data: data
    }).done(function(Data){
        if(Data.status == 3)
        {
            alert('خطای سیستمی رخ داده است، لطفا دوباره تلاش کنید.');
            window.location = base_url();
        }
        else if(Data.status == 4)
        {
            alert('در هنگام ثبت نام کارت شما خطایی رخ داده است، لطفا با بخش پشتیبانی سامانه تماس حاصل فرمائید.');
            window.location = base_url();
        }
        else if(Data.status == 5)
        {
            progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
            progress.hide();
            var html = 'همیار گرامی،' + '<br>' + 'ثبت نام شما با موفقیت انجام شد، تا لحظاتی دیگر کارت اهدای عضو شما آماده می شود.';
            wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-success').html(html).show();
            dbCheckBtn.hide();
            setTimeout(function(){
                window.location = base_url() + 'users';
            }, 5000);
        }
        else if(Data.status == 6)
        {
            alert('در هنگام ثبت نام کارت شما خطایی رخ داده است، لطفا با بخش پشتیبانی سامانه تماس حاصل فرمائید.');
            window.location = base_url();
        }
        else if(Data.status == 7)
        {
            alert('خطای سیستمی رخ داده است، لطفا دوباره تلاش کنید.');
            window.location = base_url();
        }
        else
        {
            alert('خطای سیستمی رخ داده است، لطفا دوباره تلاش کنید.');
            window.location = base_url();
        }
    }).fail(function(){
        registerUser(data);
    });
}

//=======================================================================
//=======================================================================
//=======================================================================
$(document).ready(function() {
    prepare();
});
//=======================================================================
function prepare()
{
    var st = '<option value="0">انتخاب کنید...</option>';
    for(var k in state)
    {
        st += '<option value="' + state[k].id + '">' + state[k].name + '</option>';
    }
    $('#cbRegisterState').html(st);

    // chnage organ on click
    $("[name=chRegisterAll]").on("change" , function() {
        if($("[name=chRegisterAll]").is(":checked"))
        {
            $("[name=chRegisterHeart],[name=chRegisterLung],[name=chRegisterLiver],[name=chRegisterKidney],[name=chRegisterPancreas],[name=chRegisterTissues]").prop('checked', true).parent().addClass("active").attr("disabled", true);
        }
        else
        {
            $("[name=chRegisterHeart],[name=chRegisterLung],[name=chRegisterLiver],[name=chRegisterKidney],[name=chRegisterPancreas],[name=chRegisterTissues]").prop('checked', false).parent().removeClass("active").attr("disabled", false);
        }

    });

    //$('.cardFirst').on('mouseover', function(){
    //    $('.cardFirst').animate({opacity : 0}, 500, function(){
    //        $('.cardFirst').attr("src", base_url() + "assets/images/cardwing_e.png");
    //    }).animate({opacity : 1}, 500);
    //}).on('mouseout', function(){
    //    $('.cardFirst').animate({opacity : 0}, 500, function(){
    //        $('.cardFirst').attr("src", base_url() + "assets/images/card_e.png");
    //    }).animate({opacity : 1}, 500);
    //});

    //$('.angelsPic').on('mouseover', function(){
    //    $('.angelsPic').animate({opacity: 0.6}, 500);
    //    $(this).animate({opacity: 1}, 1);
    //}).on('mouseout', function(){
    //    $('.angelsPic').animate({opacity: 1}, 500);
    //});

    //$('.modal').on('hidden.bs.modal', function (e) {
    //    $.fn.fullpage.setAllowScrolling(true);
    //}).on('show.bs.modal', function(e){
    //    $.fn.fullpage.setAllowScrolling(false);
    //});

    $('[data-toggle="tooltip"]').tooltip();

    setTimeout(function(){
        slideShow();
    }, 5000);

    // btn background transition
    $('.transitionBtn').mouseenter(function(){
        $(this).stop().animate({backgroundColor : '#06CDDB'}, 750);
    }).mouseleave(function(){
        $(this).stop().animate({'backgroundColor' : '#51B9ED'}, 750);
    });

    // set slider margin top on document load
    var navbarHeight = $('.navbar').height();
    $('#navbarHeightSpace').css({'margin-top':navbarHeight});
}

//=======================================================================
function userLogin()
{
    var username = $('#txtLoginUsername');
    var password = $('#txtLoginPassword');
    var qs = $('#txtLoginQa');
    var qsLabel = $('#qaLabel');
    var qsk = $('#txtLoginQsK');
    var alert = $('#loginFormAlert');
    var msg = $('#loginFormMsg');
    var btn = $('#loginBtns .btn');
    var load = $('#progress');
    load.show();
    alert.hide();
    btn.removeAttr('disabled', 'disabled').prop('disabled', false);

    if(username.val().length > 4 && password.val().length > 4 && qs.val().length > 0 && qsk.val().length > 1)
    {
        btn.attr('disabled', 'disabled').prop('disabled', true);
        // ajax
        var j = 1;
        if(j > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "ajax/processing/userLogin",
                cache: false,
                data: {username: username.val(), password: password.val(), qs: qs.val(), qsk: qsk.val()}
            }).done(function(Data){
                if(Data.msg == 1)
                {
                    window.location = base_url() + 'users';
                }
                else if(Data.msg == 2)
                {
                    btn.removeAttr('disabled', 'disabled').prop('disabled', false);
                    qsk.val(Data.key);
                    qsLabel.html('حاصل ' + Data.qs + '؟');
                    msg.text('نام کاربری/رمز عبور صحیح نمی باشد.');
                    load.hide();
                    alert.show();
                }
                else if(Data.msg == 3)
                {
                    btn.removeAttr('disabled', 'disabled').prop('disabled', false);
                    msg.text('پاسخ سوال امنیتی صحیح نمی باشد.');
                    qsk.val(Data.key);
                    qsLabel.html('حاصل ' + Data.qs + '؟');
                    load.hide();
                    alert.show();
                }
                else
                {
                    alert('خطایی رخ داده است، دوباره تلاش کنید.');
                }
                load.hide();

            });
            j--;
        }
    }
    else
    {
        msg.text('تمامی گزینه ها را تکمیل نمائید.');
        load.hide();
        alert.show();
    }
}

function changeUserPassword()
{
    var oldPass = $("#txtOldUserPassword");
    var newPass = $("#txtNewUserPassword");
    var newPassVerify = $("#txtNewUserPasswordVerify");
    var load = $("#changePassLoad");
    var alertw = $("#userPasswordAlert");
    var msg = $("#userPasswordAlertMsg");
    var btn = $("#changePassBtn .btn");
    var err = 0;
    btn.prop('disabled', true);
    load.show();
    alertw.hide();
    alertw.removeClass('alert-success').removeClass('alert-warning');

    if(oldPass.val().length < 4)
    {
        err++;
        oldPass.parent().removeClass('has-success').addClass('has-error');
    }
    else
    {
        oldPass.parent().removeClass('has-error').addClass('has-success');
    }

    // password and verify password validate
    var passVal = convertDigitToIn(newPass.val());
    var vPassVal = convertDigitToIn(newPassVerify.val());
    if(!/^[A-Za-z0-9!@#$%^&*()_\-\.]{6,32}$/.test(passVal))
    {
        err++;
        newPass.parent().removeClass('has-success').addClass('has-error');
    }
    else
    {
        newPass.parent().removeClass('has-error').addClass('has-success');
        newPass.val(passVal);
    }

    if(passVal != vPassVal || vPassVal.length < 6)
    {
        err++;
        newPassVerify.parent().removeClass('has-success').addClass('has-error');
    }
    else
    {
        newPassVerify.parent().removeClass('has-error').addClass('has-success');
        newPassVerify.val(vPassVal);
    }

    if(err > 0)
    {
        msg.html('تمامی گزینه ها را به درستی تکمیل نمائید.');
        load.hide();
        alertw.addClass('alert-warning').show();
        btn.prop('disabled', false);
    }
    else
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "ajax/processing/changeUserPassword",
                cache: false,
                data: {
                    oldPass: oldPass.val(),
                    newPass: newPass.val(),
                    newPassV: newPassVerify.val()
                     }
            }).done(function(Data){
                if(Data.msg == 1)
                {
                    msg.html('برای تغییر رمز عبور مجدداً وارد سامانه شوید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                }
                else if(Data.msg == 2)
                {
                    alert('خطای سیستمی رخ داده است، دوباره سعی نمائید.');
                    window.location = base_url();
                }
                else if(Data.msg == 3)
                {
                    msg.html('رمز قدیمی را به درستی وارد نمائید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                }
                else if(Data.msg == 4)
                {
                    msg.html('رمز جدید را به درستی وارد نمائید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                }
                else if(Data.msg == 5)
                {
                    msg.html('رمز جدید و تکرار آن مطابقت ندارد.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                }
                else if(Data.msg == 6)
                {
                    msg.html('رمز عبور جدید با موفقیت ذخیره گردید، جهت ادامه می‌بایست دوباره وارد سامانه شوید.');
                    load.hide();
                    alertw.removeClass('alert-warning').addClass('alert-success').show();
                    btn.prop('disabled', false);
                    setTimeout(function(){
                        window.location = base_url() + 'home/logOut';
                    }, 4000);
                }
            }).fail(function(){
                msg.html('خطای سیستمی رخ داده است، دوباره سعی نمائید.');
                load.hide();
                alertw.addClass('alert-warning').show();
                btn.prop('disabled', false);
            });
            j--;
        }
    }

}

function forgotPassword()
{
    var national = $("#txtForgotNationalCode");
    var user = $("#txtForgotUsername");
    var email = $("#txtForgotEmail");
    var qs = $("#txtForgotQa");
    var qsk = $("#txtForgotQaK");
    var qaForgotLabel = $("#qaForgotLabel");
    var txtForgotQaK = $("#txtForgotQaK");
    var load = $("#forgotPassLoad");
    var alertw = $("#forgotPasswordAlert");
    var msg = $("#forgotPasswordAlertMsg");
    var btn = $("#forgotPassBtn .btn");
    var err = 0;
    var sh = 0;
    btn.prop('disabled', true);
    load.show();
    alertw.hide();
    alertw.removeClass('alert-success').removeClass('alert-warning');

    // national code validate
    var nationalVal = convertDigitToIn(national.val());
    if(nationalVal.length != 10 || !is_numeric(nationalVal) || !nationalCodeVerify(nationalVal))
    {
        err++;
        national.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
    }
    else
    {
        national.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
        national.val(convertDigitToPer(nationalVal));
    }

    // email if user entered validate
    var emailVal = convertDigitToIn(email.val());
    if(emailVal.length > 0)
    {
        if(!checkEmail(emailVal))
        {
            err++;
            email.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
        }
        else
        {
            email.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
            email.val(emailVal);
        }
    }
    else
    {
        sh++;
    }

    // username validate
    var usernameVal = convertDigitToIn(user.val());
    if(usernameVal.length > 0)
    {
        if(!/^[A-Za-z0-9_\-\.]{6,32}$/.test(usernameVal))
        {
            err++;
            user.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
        }
        else
        {
            user.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
            user.val(usernameVal);
        }
    }
    else
    {
        sh++;
    }

    if(qs.val() < 1 || qs.val().length < 1)
    {
        err++
        qs.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
    }
    else
    {
        qs.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
    }

    if(err > 0 || sh > 1)
    {
        if(sh > 1)
        {
            user.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
            email.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
        }
        else
        {
            user.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
            email.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
        }
        msg.html('تمامی گزینه ها را به درستی تکمیل نمائید.');
        load.hide();
        alertw.addClass('alert-warning').show();
        btn.prop('disabled', false);
    }
    else
    {
        user.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
        email.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
        var j = 1;
        if(j > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "ajax/processing/forgotPassword",
                cache: false,
                data: {
                    nationalcode: convertDigitToIn(nationalVal),
                    username: convertDigitToIn(usernameVal),
                    email: convertDigitToIn(emailVal),
                    qs: convertDigitToIn(qs.val()),
                    qsk: qsk.val()
                     }
            }).done(function(Data){
                if(Data.msg == 1)
                {
                    msg.html('کد امنیتی را به درستی وارد نمائید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
                else if(Data.msg == 2)
                {
                    msg.html('برای این کد ملی تا کنون در این سامانه ثبت نام کارت اهدای عضو انجام نشده است.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
                else if(Data.msg == 3)
                {
                    msg.html('نام کاربری یا ایمیل وارد شده صحیح نمی باشد.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
                else if(Data.msg == 4)
                {
                    msg.html('برای این کد ملی در هنگام ثبت نام ایمیل معتبر وارد نشده است، جهت بازنشانی رمز عبور از روش فوق استفاده نمائید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
                else if(Data.msg == 5)
                {
                    msg.html('یک ایمیل حاوی اطلاعات لازم جهت بازنشانی رمز عبور به آدرس شما ارسال گردید.'+ '<br>' + 'در صورت عدم دریافت ایمیل پوشه spam یا junk خود را چک نمائید.');
                    load.hide();
                    alertw.addClass('alert-success').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                    document.forgotPasswordForm.reset();

                }
                else
                {
                    msg.html('خطای سیستمی رخ داده است، دوباره سعی نمائید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
            }).fail(function(){
                msg.html('خطای سیستمی رخ داده است، دوباره سعی نمائید.');
                load.hide();
                alertw.addClass('alert-warning').show();
                btn.prop('disabled', false);
            });
            j--;
        }
    }

}

function submitEditForm()
{
    var name = $("#txtRegisterFirstName");
    var family = $("#txtRegisterLastName");
    var father = $("#txtRegisterFatherName");
    var sex = $("#cbRegisterGender");
    var idNumber = $("#txtRegisterIDNumber");
    var birth = $("#cbRegisterBirthDate");
    var birthExtra = $("#txtExtraBirthday");
    var placeOfBirth = $("#txtRegisterPlaceOfBirth");
    var edu = $("#cbRegisterEducation");
    var job = $("#txtRegisterJob");
    var mob = $("#txtRegisterMobile");
    var tel = $("#txtRegisterTel");
    var st = $("#cbRegisterState");
    var ci = $("#cbRegisterCity");
    var address = $("#txtEditAddress");
    var postal = $("#txtEditPostalCode");
    var email = $("#txtRegisterEmail");
    var chAll = $("#chRegisterAll");
    var chHeart = $("#chRegisterHeart");
    var chLung = $("#chRegisterLung");
    var chLiver = $("#chRegisterLiver");
    var chKindney = $("#chRegisterKidney");
    var chPancreas = $("#chRegisterPancreas");
    var chTissues = $("#chRegisterTissues");
    var dbCheck = $("#txtDbCheck");
    var progressVal = $("#progressVal");
    var progress = $(".progress");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");
    var form =  $("#editForm");
    var btns = $("#divBtn .btn");
    var err = 0;
    var msg = new Array;
    btns.attr('disabled', 'disabled');
    wAlert.hide();

    progress.show();
    $('.has-error,  .has-success').removeClass('has-success').removeClass('has-error');

    // first name validate
    if(name.val().length < 2 || is_numeric(name.val()))
    {
        err++;
        name.parent().addClass('has-error');
        msg.push('نام را به صورت صحیح وارد نمائید.');
    }
    else
    {
        name.parent().addClass('has-success');
    }

    // last name validate
    if(family.val().length < 2 || is_numeric(family.val()))
    {
        err++;
        family.parent().addClass('has-error');
        msg.push('نام خانوادگی را به صورت صحیح وارد نمائید.');
    }
    else
    {
        family.parent().addClass('has-success');
    }

    // sex validate
    if(sex.val() < 1 || sex.val() > 2)
    {
        err++;
        sex.parent().addClass('has-error');
        msg.push('جنسیت خود را انتخاب نمائید.');
    }
    else
    {
        sex.parent().addClass('has-success');
    }

    // father name validate
    if(father.val().length < 2 || is_numeric(father.val()))
    {
        err++;
        father.parent().addClass('has-error');
        msg.push('نام پدر را به صورت صحیح وارد نمائید.');
    }
    else
    {
        father.parent().addClass('has-success');
    }

    // id number validate
    var idNumberVal = convertDigitToIn(idNumber.val());
    if(idNumberVal.length < 1 || !is_numeric(idNumberVal) || idNumberVal < 1)
    {
        err++;
        idNumber.parent().addClass('has-error');
        msg.push('شماره شناسنامه خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        idNumber.parent().addClass('has-success');
    }

    // birth date validate
    if(birth.val().length < 7 || birthExtra.val().length < 7 || birth.hasClass("invalid"))
    {
        err++;
        birth.parent().addClass('has-error');
        msg.push('تاریخ تولد خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        birth.parent().addClass('has-success');
    }

    // place of birth validate
    if(placeOfBirth.val().length < 2 || is_numeric(placeOfBirth.val()))
    {
        err++;
        placeOfBirth.parent().addClass('has-error');
        msg.push('محل تولد خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        placeOfBirth.parent().addClass('has-success');
    }

    // mobile number validate
    var mobVal = convertDigitToIn(mob.val());
    if(mobVal.length != 11 || !is_numeric(mobVal) || mobVal[0] != 0 || mobVal[1] != 9)
    {
        err++;
        mob.parent().addClass('has-error');
        msg.push('شماره همراه خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        mob.parent().addClass('has-success');
    }

    // phone number validate
    var telVal = convertDigitToIn(tel.val());
    if(telVal.length != 11 || !is_numeric(telVal) || telVal[0] != 0)
    {
        err++;
        tel.parent().addClass('has-error');
        msg.push('شماره تلفن ثابت خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        tel.parent().addClass('has-success');
    }

    // state validate
    if(st.val() < 1)
    {
        err++;
        st.parent().addClass('has-error');
        msg.push('استان خود را انتخاب نمائید.');
    }
    else
    {
        st.parent().addClass('has-success');
    }

    // city validate
    if(ci.val() < 1)
    {
        err++;
        ci.parent().addClass('has-error');
        msg.push('شهر خود را انتخاب نمائید.');
    }
    else
    {
        ci.parent().addClass('has-success');
    }

    if(postal.val().length > 0)
    {
        if(postal.val().length != 10 || !is_numeric(convertDigitToIn(postal.val())))
        {
            err++;
            postal.parent().addClass('has-error');
            msg.push('کدپستی خود را به صورت صحیح وارد نمائید.');
        }
        else
        {
            postal.parent().addClass('has-success');
        }
    }

    // email if user entered validate
    var emailVal = convertDigitToIn(email.val());
    if(emailVal.length > 0)
    {
        if(!checkEmail(emailVal))
        {
            err++;
            email.parent().addClass('has-error');
            msg.push('ایمیل خود را به صورت صحیح وارد نمائید.');
        }
        else
        {
            email.parent().addClass('has-success');
            email.val(emailVal);
        }
    }

    // organs validate
    if(chAll.is(":checked") || chHeart.is(":checked") || chKindney.is(":checked") || chLiver.is(":checked") || chLung.is(":checked") || chPancreas.is(":checked") || chTissues.is(":checked"))
    {
        $("#organCheck").parent().addClass('has-success');
    }
    else
    {
        err++;
        $("#organCheck").parent().addClass('has-error');
        msg.push('حداقل یکی از ارگان ها را جهت اهدا انتخاب نمائید.');
    }

    // convert birth date to english number when user try to edit that
    birth.on('focus', function(){
        birth.val(convertDigitToIn(birth.val()));
    });


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
            var cbRegisterEducation = ($('#cbRegisterEducation :selected').text());
            var cbRegisterEducationVal = ($('#cbRegisterEducation :selected').val());
            var cbRegisterState = ($('#cbRegisterState :selected').text());
            var cbRegisterStateVal = ($('#cbRegisterState :selected').val());
            var cbRegisterCity = ($('#cbRegisterCity :selected').text());
            var cbRegisterCityVal = ($('#cbRegisterCity :selected').val());
            $("form#editForm :input, form#editForm select, form#editForm :checkbox").each(function(){
                var input = $(this);
                input.val(convertDigitToIn(input.val()));
            });

            var data = form.serialize();

            $("form#editForm :input, form#editForm select, form#editForm :checkbox").each(function(){
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
                    url: base_url() + "ajax/processing/updateUserData",
                    cache: false,
                    data: data
                }).done(function(Data){
                    if(Data.msg == 2) // update data success
                    {
                        progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
                        progress.hide();
                        var html = 'اطلاعات شما با موفقیت ذخیره گردید. جهت مشاهده کارت خود ';
                        html += '<a href="' + base_url() + 'users">اینجا</a>';
                        html += ' کلیک نمائید.';
                        wAlertMsg.html(html)
                        wAlert.removeClass('alert-warning').addClass('alert-success').show();
                        btns.attr('disabled', false).prop('disabled', false);
                    }
                    else if(Data.msg == 1) // update data fail
                    {
                        progress.hide();
                        var html = 'موارد خواسته شده را به درستی تکمیل نمائید.';
                        wAlertMsg.html(html)
                        wAlert.removeClass('alert-warning').addClass('alert-warning').show();
                        btns.attr('disabled', false).prop('disabled', false);
                    }
                    else if(Data.msg < 1) // user not login
                    {
                        window.location = base_url();
                    }
                    else // validate problem
                    {
                        alert('خطای سیستمی رخ داده است، لطفا دوباره سعی نمائید.');
                        window.location = base_url();
                    }
                    // restore edit form
                    sex.val(cbRegisterGenderVal);
                    edu.val(cbRegisterEducationVal);
                    st.val(cbRegisterStateVal);
                    ci.val(cbRegisterCityVal);
                    $("form#editForm :input, form#editForm select, form#editForm :checkbox").each(function(){
                        var input = $(this);
                        input.prop('disabled', false).removeAttr("disabled", false);
                        $(".pcalBtn").show();
                        if(input.is(":checkbox")) {
                            input.removeClass('disabled').parent().prop('disabled', false).removeAttr("disabled", false);
                        }
                        input.val(convertDigitToIn(input.val()));
                    });
                }).fail(function() {
                    progress.hide();
                    wAlertMsg.html('خطای سیستمی رخ داده است، مجدداً تلاش نمائید.')
                    wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                    btns.attr('disabled', false).prop('disabled', false);
                    sex.val(cbRegisterGenderVal);
                    edu.val(cbRegisterEducationVal);
                    st.val(cbRegisterStateVal);
                    ci.val(cbRegisterCityVal);
                    $("form#editForm :input, form#editForm select, form#editForm :checkbox").each(function(){
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
            }
        }
    }

    return false; // for safety
}

function changePassByForgot()
{
    var pass = $("#txtfPassword");
    var passv = $("#txtfPasswordVerify");
    var qs = $("#txtfPassQa");
    var qsk = $("#txtfPassQaK");
    var auth = $("#txtfPassAuth");
    var qaForgotLabel = $("#qaPassLabel");
    var txtForgotQaK = $("#txtfPassQaK");
    var load = $("#fPassLoad");
    var alertw = $("#fPasswordAlert");
    var msg = $("#fPasswordAlertMsg");
    var btn = $("#fPassBtn .btn");
    var err = 0;
    btn.prop('disabled', true);
    load.show();
    alertw.hide();
    alertw.removeClass('alert-success').removeClass('alert-warning');

    var passVal = convertDigitToIn(pass.val());
    var vPassVal = convertDigitToIn(passv.val());
    if(!/^[A-Za-z0-9!@#$%^&*()_\-\.]{6,32}$/.test(passVal))
    {
        err++;
        pass.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
    }
    else
    {
        pass.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
        pass.val(passVal);
    }

    // password and verify password validate
    if(passVal != vPassVal || vPassVal.length < 6)
    {
        err++;
        passv.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
        pass.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
    }
    else
    {
        passv.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
        pass.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
        passv.val(vPassVal);
    }

    if(qs.val() < 1 || qs.val().length < 1)
    {
        err++
        qs.parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
    }
    else
    {
        qs.parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
    }

    if(err > 0)
    {
        msg.html('تمامی گزینه ها را به درستی تکمیل نمائید.');
        load.hide();
        alertw.addClass('alert-warning').show();
        btn.prop('disabled', false);
    }
    else
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "ajax/processing/changePassByForgot",
                cache: false,
                data: {
                    pass: convertDigitToIn(passVal),
                    passV: convertDigitToIn(vPassVal),
                    qs: convertDigitToIn(qs.val()),
                    qsk: qsk.val(),
                    auth: auth.val()
                }
            }).done(function(Data){
                if(Data.msg == 1)
                {
                    msg.html('کد امنیتی را به درستی وارد نمائید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
                else if(Data.msg == 2)
                {
                    window.location = base_url();
                }
                else if(Data.msg == 3)
                {
                    window.location = base_url();
                }
                else if(Data.msg == 4)
                {
                    msg.html('رمز عبور وارد شده معتبر نمی باشد.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
                else if(Data.msg == 5)
                {
                    msg.html('رمز عبور با موفقیت ذخیره گردید.');
                    load.hide();
                    alertw.addClass('alert-success').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                    document.fPasswordForm.reset();

                }
                else
                {
                    msg.html('خطای سیستمی رخ داده است، دوباره سعی نمائید.');
                    load.hide();
                    alertw.addClass('alert-warning').show();
                    btn.prop('disabled', false);
                    qaForgotLabel.html('حاصل' + Data.qs + '؟');
                    txtForgotQaK.html(Data.key);
                }
            }).fail(function(){
                msg.html('خطای سیستمی رخ داده است، دوباره سعی نمائید.');
                load.hide();
                alertw.addClass('alert-warning').show();
                btn.prop('disabled', false);
            });
            j--;
        }
    }

}

function onlineNafas()
{
    text = $('#onlineNafas');

    text.delay(500).animate({color: 'green'}, 500).delay(500).animate({color: 'red'}, 500).delay(500).animate({color: 'green'}, 500).delay(500).animate({color: 'red'}, 500).delay(500).animate({color: '#777'}, 1000);

    setTimeout(function(){ onlineNafas(); }, 5000);

}

function slideShow()
{
    $('.fp-next').click();
    setTimeout(function(){
        slideShow();
    }, 5000);
}

function aboutUsSection(section)
{
    if(section == 'aboutUsSection')
    {
        $('#foundersSection').slideUp('fast');
        $('#directorsSection').slideUp('fast');
        $('#trusteesSection').slideUp('fast');
        $('#aboutUsSection').slideDown('fast');
    }
    else if(section == 'foundersSection')
    {
        $('#foundersSection').slideDown('fast');
        $('#directorsSection').slideUp('fast');
        $('#trusteesSection').slideUp('fast');
        $('#aboutUsSection').slideUp('fast');
    }
    else if(section == 'directorsSection')
    {
        $('#foundersSection').slideUp('fast');
        $('#directorsSection').slideDown('fast');
        $('#trusteesSection').slideUp('fast');
        $('#aboutUsSection').slideUp('fast');
    }
    else if(section == 'trusteesSection')
    {
        $('#foundersSection').slideUp('fast');
        $('#directorsSection').slideUp('fast');
        $('#trusteesSection').slideDown('fast');
        $('#aboutUsSection').slideUp('fast');
    }
}

function safiranExam()
{
    var name = $("#txtRegisterFirstName");
    var family = $("#txtRegisterLastName");
    var nationalCode = $('#txtRegisterNationalCode');
    var email = $("#txtRegisterEmail");
    var userId = $('#txtUserId');
    var userNational = $('#txtUserNational');
    var progressVal = $("#progressVal");
    var progress = $(".progress");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");
    var registerForm = $("#registerForm");
    var safiranExam = $("#safiranExam");
    var safiranComplateForm = $("#safiranComplateForm");
    var answerSheetBtn = $("#submitAnswerSheet");
    var answersBtn = $("#answersBtn");
    var btns = $("#divBtn .btn");
    var err = 0;
    var msg = new Array;
    progress.show();
    $('.has-error,  .has-success').removeClass('has-success').removeClass('has-error');
    wAlert.removeClass('alert-warning').removeClass('alert-success');

    // first name validate
    if(name.val().length < 2 || is_numeric(name.val()))
    {
        err++;
        name.parent().addClass('has-error');
        msg.push('نام را به صورت صحیح وارد نمائید.');
    }
    else
    {
        name.parent().addClass('has-success');
    }

    // last name validate
    if(family.val().length < 2 || is_numeric(family.val()))
    {
        err++;
        family.parent().addClass('has-error');
        msg.push('نام خانوادگی را به صورت صحیح وارد نمائید.');
    }
    else
    {
        family.parent().addClass('has-success');
    }

    // national code validate
    var nationalVal = convertDigitToIn(nationalCode.val());
    if(nationalVal.length != 10 || !is_numeric(nationalVal) || !nationalCodeVerify(nationalVal))
    {
        err++;
        nationalCode.parent().addClass('has-error');
        msg.push('کدملی خود را به صورت صحیح وارد نمائید.');
        wAlert.show();
    }
    else
    {
        nationalCode.parent().addClass('has-success');
        //nationalCode.val(convertDigitToPer(nationalVal));
    }

    // email validate
    var emailVal = convertDigitToIn(email.val());
    if(!checkEmail(emailVal))
    {
        err++;
        email.parent().addClass('has-error');
        msg.push('ایمیل خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        email.parent().addClass('has-success');
        email.val(emailVal);
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
    else
    {
        var safirData = registerForm.serialize();
        wAlertMsg.html('');
        wAlert.hide();
        name.prop('disabled', true).attr('disabled', true);
        family.prop('disabled', true).attr('disabled', true);
        email.prop('disabled', true).attr('disabled', true);
        nationalCode.prop('disabled', true).attr('disabled', true);
        btns.prop('disabled', true).attr('disabled', true);
        progressVal.delay(1000).animate({width : "40%"}, 500);
        var x = 1;
        if(x > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "ajax/processing/safiranNewExam",
                cache: false,
                data: safirData
            }).done(function(Data){
                if(Data.status == 1 || Data.status == 3)
                {
                    btns.hide();
                    userId.val(Data.safirId);
                    $('#txtUserData').val(Data.safirId);
                    userNational.val(Data.safirNational);
                    $('#txtUserNationalCode').val(Data.safirNational);
                    registerForm.slideUp(500, function(){
                        safiranExam.slideDown(500);
                        progress.hide();
                    });
                }
                else if(Data.status == 2)
                {
                    progress.hide();
                    btns.prop('disabled', false).attr('disabled', false);
                    wAlert.addClass('alert-warning');
                    wAlertMsg.html('شما هم اکنون سفیر اهدای عضو هستید و امکان شرکت در آزمون را ندارید.');
                    wAlert.show();
                }
                else if(Data.status == 4)
                {
                    progress.hide();
                    btns.prop('disabled', false).attr('disabled', false);
                    wAlert.addClass('alert-warning');
                    wAlertMsg.html('هر شخص می تواند در یک روز تنها یک بار در آزمون شرکت نماید.');
                    wAlert.show();
                }
                else if(Data.status == 5)
                {
                    progress.hide();
                    btns.prop('disabled', false).attr('disabled', false);
                    wAlert.addClass('alert-warning');
                    wAlertMsg.html('اطلاعات خواسته شده را به درستی تکمیل نمائید.');
                    wAlert.show();
                }
                else
                {
                    progress.hide();
                    btns.prop('disabled', false).attr('disabled', false);
                    wAlert.addClass('alert-warning');
                    wAlertMsg.html('خطای سیستمی رخ داده است، لطفاً دوباره سعی نمائید.');
                    wAlert.show();
                }
            }).fail(function() {
                progress.hide();
                wAlertMsg.html('خطای سیستمی رخ داده است، مجدداً تلاش نمائید.');
                wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                btns.attr('disabled', false).prop('disabled', false);
            });
            x--;

        }

        // click on submit answer sheet btn
        answerSheetBtn.unbind('click').bind('click', function(){
            if(confirm('آیا از ارسال پاسخنامه اطمینان دارید؟'))
            {
                answersBtn.attr('disabled', true).prop('disabled', true);
                progressVal.delay(1000).animate({width : "80%"}, 500);
                var j = 1;
                if(j > 0)
                {
                    $.ajax({
                        dataType: "json",
                        type: "POST",
                        url: base_url() + "ajax/processing/safiranSubmitExam",
                        cache: false,
                        data: safiranExam.serialize()
                    }).done(function(Data){
                        if(Data.status == 1)
                        {
                            alert('خطای سیستمی رخ داده است.');
                            window.location = base_url();
                        }
                        else if(Data.status == 2)
                        {
                            if(Data.examScore == 'success' && Data.score > 49)
                            {
                                progress.hide();
                                answersBtn.hide();
                                $('#nextLevel').show();
                                wAlert.addClass('alert-success');
                                var htmlData = 'ضمن عرض تبریک به اطلاع می رساند، شما آزمون تئوری سفیران اهدی عضو را با کسب نمره ';
                                htmlData += Data.score + ' از 100 با موفقیت به اتمام رسانده اید. <br>';
                                htmlData += 'لطفاً برای تکمیل فرم ثبت نام خود برروی دکمه مرحله بعدی کلیک نمائید.';
                                wAlertMsg.html(htmlData);
                                wAlert.show();
                            }
                            else
                            {
                                progress.hide();
                                answersBtn.hide();
                                wAlert.addClass('alert-warning');
                                var htmlData = 'متاسفانه شما با کسب نمره '
                                htmlData += Data.score + ' از 100 نتوانستید آزمون تئوری سفیران اهدای عضو را با موفقیت به اتمام برسانید.<br>';
                                htmlData += 'شما می توانید 24 ساعت آینده دوباره در این آزمون شرکت نمائید. باتشکر';
                                wAlertMsg.html(htmlData);
                                wAlert.show();
                            }
                        }
                        else
                        {
                            progress.hide();
                            answersBtn.prop('disabled', false).attr('disabled', false);
                            wAlert.addClass('alert-warning');
                            wAlertMsg.html('خطای سیستمی رخ داده است، لطفاً دوباره سعی نمائید.');
                            wAlert.show();
                        }
                    }).fail(function() {
                        progress.hide();
                        wAlertMsg.html('خطای سیستمی رخ داده است، مجدداً تلاش نمائید.');
                        wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                        answersBtn.attr('disabled', false).prop('disabled', false);
                    });
                    j--;

                }
            }
        });

        // click on next level btn
        $('#nextLevelBtn').unbind('click').bind('click', function(){
            safiranExam.slideUp(500, function(){
                registerForm.show();
                safiranComplateForm.slideDown();
                wAlert.hide().removeClass('alert-warning').removeClass('alert-info').removeClass('alert-success');
                wAlertMsg.html('');
            });
        });

    }

}

function safiranSubmitExtra()
{
    var sex = $("#cbRegisterGender");
    var birth = $("#cbRegisterBirthDate");
    var birthExtra = $("#txtExtraBirthday");
    var maried = $("#cbRegisterMaried");
    var edu = $("#txtEducation");
    var eduCity = $("#txtEducationCity");
    var numOfMon = $("#txtNumberOfMonth");
    var job = $("#txtJob");
    var mob = $("#txtMobile");
    var tel = $("#txtHomeTel");
    var jobTel = $("#txtJobTel");
    var emerTel = $("#txtEmergencyTel");
    var homeAddress = $("#txtHomeAddress");
    var jobAddress = $("#txtJobAddress");
    var detail = $("#txtOtherDetail");
    var userId = $('#txtUserData');
    var userNational = $('#txtUserNationalCode');
    var introduction = $('#cbIntroduction');
    var farakhan = $('#txtFarakhan');

    var progressVal = $("#progressVal");
    var progress = $(".progress");
    var wAlert = $("#warningAlert");
    var wAlertMsg = $("#registerFormMsg");
    var registerForm = $("#registerForm");
    var safiranExam = $("#safiranExam");
    var safiranComplateForm = $("#safiranComplateForm");

    var err = 0;
    var msg = new Array;
    progress.show();
    $('.has-error,  .has-success').removeClass('has-success').removeClass('has-error');
    wAlert.removeClass('alert-warning').removeClass('alert-success');

    // sex validate
    if(sex.val() < 1 || sex.val() > 2)
    {
        err++;
        sex.parent().addClass('has-error');
        msg.push('جنسیت خود را انتخاب نمائید.');
    }
    else
    {
        sex.parent().addClass('has-success');
    }

    // birth date validate
    if(birth.val().length < 7 || birthExtra.val().length < 7 || birth.hasClass("invalid"))
    {
        err++;
        birth.parent().addClass('has-error');
        msg.push('تاریخ تولد خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        birth.parent().addClass('has-success');
    }

    // maried validate
    if(maried.val() < 1 || maried.val() > 2)
    {
        err++;
        maried.parent().addClass('has-error');
        msg.push('وضعیت تاهل خود را انتخاب نمائید.');
    }
    else
    {
        maried.parent().addClass('has-success');
    }

    // edu validate
    if(edu.val().length < 2 || is_numeric(edu.val()))
    {
        err++;
        edu.parent().addClass('has-error');
        msg.push('آخرین مدرک تحصیلی خود را وارد نمائید.');
    }
    else
    {
        edu.parent().addClass('has-success');
    }

    // place of edu validate
    if(eduCity.val().length < 2 || is_numeric(eduCity.val()))
    {
        err++;
        eduCity.parent().addClass('has-error');
        msg.push('محل اخذ مدرک خود را به درستی وارد نمائید.');
    }
    else
    {
        eduCity.parent().addClass('has-success');
    }

    // number day in month validate
    if(numOfMon.val().length < 1)
    {
        err++;
        numOfMon.parent().addClass('has-error');
        msg.push('تعداد روزهایی که در ماه می توانید با این مرکز همکاری داشته باشید را به درستی وارد نمائید.');
    }
    else
    {
        numOfMon.parent().addClass('has-success');
    }

    // job validate
    if(job.val().length < 2 || is_numeric(job.val()))
    {
        err++;
        job.parent().addClass('has-error');
        msg.push('شغل خود را وارد نمائید.');
    }
    else
    {
        job.parent().addClass('has-success');
    }

    // home address validate
    if(homeAddress.val().length < 3 || is_numeric(homeAddress.val()))
    {
        err++;
        homeAddress.parent().addClass('has-error');
        msg.push('آدرس منزل خود را وارد نمائید.');
    }
    else
    {
        homeAddress.parent().addClass('has-success');
    }

    // job address validate
    if(jobAddress.val().length < 3 || is_numeric(jobAddress.val()))
    {
        err++;
        jobAddress.parent().addClass('has-error');
        msg.push('آدرس محل کار خود را وارد نمائید.');
    }
    else
    {
        jobAddress.parent().addClass('has-success');
    }

    // mobile number validate
    var mobVal = convertDigitToIn(mob.val());
    if(mobVal.length != 11 || !is_numeric(mobVal) || mobVal[0] != 0 || mobVal[1] != 9)
    {
        err++;
        mob.parent().addClass('has-error');
        msg.push('شماره همراه خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        mob.parent().addClass('has-success');
    }

    // home phone number validate
    var telVal = convertDigitToIn(tel.val());
    if(telVal.length != 11 || !is_numeric(telVal) || telVal[0] != 0)
    {
        err++;
        tel.parent().addClass('has-error');
        msg.push('شماره تلفن منزل خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        tel.parent().addClass('has-success');
    }

    // job phone number validate
    var jobTelVal = convertDigitToIn(jobTel.val());
    if(jobTelVal.length != 11 || !is_numeric(jobTelVal) || jobTelVal[0] != 0)
    {
        err++;
        jobTel.parent().addClass('has-error');
        msg.push('شماره تلفن محل کار خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        jobTel.parent().addClass('has-success');
    }

    // emer phone number validate
    var emerTelVal = convertDigitToIn(emerTel.val());
    if(emerTelVal.length != 11 || !is_numeric(emerTelVal))
    {
        err++;
        emerTel.parent().addClass('has-error');
        msg.push('شماره تلفن ضروری خود را به صورت صحیح وارد نمائید.');
    }
    else
    {
        emerTel.parent().addClass('has-success');
    }

    // introduction validate
    if(introduction.val() < 1 || introduction.val() > 4)
    {
        err++;
        introduction.parent().addClass('has-error');
        msg.push('نحوه آشنایی خود را با انجمن وارد نمائید.');
    }
    else
    {
        introduction.parent().addClass('has-success');
    }

    // farakhan validate
    if(farakhan.val().length < 3 || is_numeric(farakhan.val()))
    {
        err++;
        farakhan.parent().addClass('has-error');
        msg.push('نحوه اطلاع از فراخوان را وارد نمائید.');
    }
    else
    {
        farakhan.parent().addClass('has-success');
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
        progress.hide();
    }
    else
    {
        wAlertMsg.html('');
        wAlert.hide();
        $('#lastFormBtn').prop('disabled', true).attr('disabled', true);
        progressVal.delay(1000).animate({width : "90%"}, 500);
        var x = 1;
        if(x > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "ajax/processing/safiranExtraData",
                cache: false,
                data: safiranComplateForm.serialize()
            }).done(function(Data){
                if(Data.status == 1)
                {
                    progressVal.animate({width : "100%"}, 500).hide(500, function(){
                        progress.hide();
                        $('#lastFormBtn').prop('disabled', true).attr('disabled', true);
                        safiranComplateForm.slideUp();
                        wAlert.addClass('alert-success');
                        var htmlData = 'اطلاعات شما با موفقیت در سامانه ثبت گردید. این اطلاعات توسط مسئول سفیران بررسی و پس از تایید برای جلسه حضوری سفیران با شما تماس گرفته خواهد شد. پس از تایید اطلاعات یک ایمیل حاوی نام کاربری و رمز عبور برای شما ارسال خواهد شد (درصورت عدم دریافت پوشه اسپم یا جانک خود را نیز بازدید نمائید).';
                        wAlertMsg.html(htmlData);
                        wAlert.show();
                    });
                }
                else
                {
                    progress.hide();
                    $('#lastFormBtn').prop('disabled', false).attr('disabled', false);
                    wAlert.addClass('alert-warning');
                    wAlertMsg.html('خطای سیستمی رخ داده است، لطفاً دوباره سعی نمائید.');
                    wAlert.show();
                }
            }).fail(function() {
                progress.hide();
                wAlertMsg.html('خطای سیستمی رخ داده است، مجدداً تلاش نمائید.');
                wAlert.removeClass('alert-warning').removeClass('alert-info').addClass('alert-warning').show();
                $('#lastFormBtn').attr('disabled', false).prop('disabled', false);
            });
            x--;

        }
    }
}