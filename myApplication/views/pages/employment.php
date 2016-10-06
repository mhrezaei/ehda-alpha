<div class="container">
    <div class="panel panel-default" style="margin-top: 5em;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-family: 'BNazanin', Tahoma; font-weight: bold;">فرم استخدام مددکار اجتماعی</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" name="registerForm" id="registerForm">

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">الف) اطلاعات عمومی</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterName" class="col-sm-2 control-label">نام و نام خانوادگی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterName" name="txtRegisterName" placeholder="نام و نام خانوادگی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterAge" class="col-sm-2 control-label">سن:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterAge" name="txtRegisterAge" placeholder="سن">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cbRegisterMar" class="col-sm-2 control-label">وضعیت تاهل:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="cbRegisterMar" name="cbRegisterMar">
                            <option value="0">انتخاب کنید...</option>
                            <option value="2">متاهل</option>
                            <option value="1">مجرد</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterEdu" class="col-sm-2 control-label">مدرک تحصیلی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterEdu" name="txtRegisterEdu" placeholder="مدرک تحصیلی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterEduType" class="col-sm-2 control-label">رشته تحصیلی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterEduType" name="txtRegisterEduType" placeholder="رشته تحصیلی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterNJob" class="col-sm-2 control-label">شغل کنونی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterNJob" name="txtRegisterNJob" placeholder="شغل کنونی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterMobile" class="col-sm-2 control-label">تلفن همراه:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterMobile" name="txtRegisterMobile" maxlength="11" placeholder="تلفن همراه خود را 11 رقمی و بدون خط تیره وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterTel" class="col-sm-2 control-label">تلفن ثابت:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterTel" name="txtRegisterTel" maxlength="11" placeholder="تلفن ثابت را 11 رقمی همراه با پیش شماره وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterAddress" class="col-sm-2 control-label">آدرس محل سکونت:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterAddress" name="txtRegisterAddress" placeholder="آدرس محل سکونت">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterAddressJob" class="col-sm-2 control-label">نام و آدرس محل کار فعلی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterAddressJob" name="txtRegisterAddressJob" placeholder="نام و آدرس محل کار فعلی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterTelJob" class="col-sm-2 control-label">تلفن محل کار فعلی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterTelJob" name="txtRegisterTelJob" placeholder="تلفن محل کار فعلی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterEmail" class="col-sm-2 control-label">ایمیل:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="txtRegisterEmail" name="txtRegisterEmail" maxlength="256" placeholder="ایمیل خود را بدون www وارد نمائید">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">ب) سوابق شغلی</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterOldJobs" class="col-sm-2 control-label">شرح سوابق شغلی:</label>
                    <div class="col-sm-9">
                        <textarea rows="5" id="txtRegisterOldJobs" class="form-control" name="txtRegisterOldJobs"></textarea>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">ج) مدارک سایر مهارت های مرتبط</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterDoc" class="col-sm-2 control-label">مدارک</label>
                    <div class="col-sm-9">
                        <textarea rows="5" class="form-control" id="txtRegisterDoc" name="txtRegisterDoc"></textarea>
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: none;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">د) نحوه آشنایی شما با انجمن</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterRel" class="col-sm-2 control-label">نحوه آشنایی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterRel" name="txtRegisterRel" placeholder="نحوه آشنایی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div style="font-family: 'BNazanin', Tahoma; font-size: 16px; font-weight: bold; color: #265A88;">ه) حقوق و مزایا</div>
                    <div style="clear: both;"></div>
                    <div class="dashtLine"></div>
                </div>

                <div class="form-group">
                    <label for="txtRegisterPr" class="col-sm-2 control-label">میزان حقوق پیشنهادی:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtRegisterPr" name="txtRegisterPr" placeholder="میزان حقوق پیشنهادی">
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-star formRequired" title="تکمیل الزامی" style="display: block;"></span>
                    </div>
                </div>
            </form>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div role="alert" class="alert alert-dismissible fade in alertP" id="warningAlert" style="display: none;">
<!--                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>-->
                            <span id="registerFormMsg" style="line-height: 20px;">تمامی گزینه ها را به درستی وارد نمائید.</span>
                        </div>
                    </div>
                    <div class="col-sm-4" style="text-align: left; padding-top: 12px;">
                        <button type="button" class="btn btn-info" onclick="submitEmploymentForm();" style="float: left; margin-left: 10px;">ارسال اطلاعات</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="progress" style="display: none; margin-top: 15px;">
                            <div class="progress-bar progress-bar-success progress-bar-striped active" id="progressVal" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <span style="font-family: 'webYekan', Tahoma;">شکیبا باشید...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
        </div>
    </div>

    <div style="clear: both; margin-top: 30px;"></div>

</div>

<script>
    function submitEmploymentForm()
    {
        var txtRegisterName = $("#txtRegisterName");
        var txtRegisterAge = $("#txtRegisterAge");
        var cbRegisterMar = $("#cbRegisterMar");
        var txtRegisterEdu = $("#txtRegisterEdu");
        var txtRegisterEduType = $("#txtRegisterEduType");
        var txtRegisterNJob = $("#txtRegisterNJob");
        var txtRegisterMobile = $("#txtRegisterMobile");
        var txtRegisterTel = $("#txtRegisterTel");
        var txtRegisterAddress = $("#txtRegisterAddress");
        var txtRegisterAddressJob = $("#txtRegisterAddressJob");
        var txtRegisterTelJob = $("#txtRegisterTelJob");
        var txtRegisterEmail = $("#txtRegisterEmail");
        var txtRegisterOldJobs = $("#txtRegisterOldJobs");
        var txtRegisterDoc = $("#txtRegisterDoc");
        var txtRegisterRel = $("#txtRegisterRel");
        var txtRegisterPr = $("#txtRegisterPr");

        var progressVal = $("#progressVal");
        var progress = $(".progress");
        var wAlert = $("#warningAlert");
        var wAlertMsg = $("#registerFormMsg");
        var form =  $("#registerForm");
        var btns =  $(".btn-info");
        var err = 0;
        var msg = new Array;
        btns.attr('disabled', 'disabled');
        wAlert.hide();

        progress.show();
        $('.has-error,  .has-success').removeClass('has-success').removeClass('has-error');

        if(txtRegisterName.val().length > 3 && txtRegisterAge.val() > 0 && cbRegisterMar.val() > 0 && txtRegisterEdu.val().length > 0 && txtRegisterEduType.val().length > 0 && txtRegisterNJob.val().length > 0 && txtRegisterMobile.val().length == 11 && txtRegisterTel.val().length == 11 && txtRegisterAddress.val().length > 0 && txtRegisterEmail.val().length > 0 && txtRegisterOldJobs.val().length > 0 && txtRegisterRel.val().length > 0 && txtRegisterPr.val().length > 0)
        {
            // ajax
            var i = 1;
            if(i > 0)
            {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: base_url() + "ajax/processing/submitEmployment",
                    cache: false,
                    data: form.serialize()
                }).done(function(Data){
                    if(Data.done == 1)
                    {
                        progressVal.delay(1000).animate({width : "100%"}, 500).delay(1000);
                        progress.hide();

                        var html = 'باتشکر از شما، اطلاعات با موفقیت ذخیره گردید در صورت نیاز با شما تماس گرفته خواهد شد.';
                        wAlertMsg.html(html);
                        wAlert.removeClass('alert-warning').addClass('alert-success').show();
                        btns.hide();
                    }
                    else if(Data.done == 2)
                    {
                        progress.hide();
                        btns.attr('disabled', false).prop('disabled', false);
                        var html = 'خطایی در ثبت اطلاعات رخ داده است، لطفا دوباره تلاش نمائید.';
                        wAlertMsg.html(html);
                        wAlert.removeClass('').addClass('alert-warning').show();
                    }
                    else // validate problem
                    {
                        alert('خطای سیستمی رخ داده است، لطفا دوباره سعی نمائید.');
                        window.location = base_url() + 'home/register';
                    }
                }).fail(function() {
                    progress.hide();
                    btns.attr('disabled', false).prop('disabled', false);
                    var html = 'خطایی در ثبت اطلاعات رخ داده است، لطفا دوباره تلاش نمائید.';
                    wAlertMsg.html(html)
                    wAlert.removeClass('').addClass('alert-warning').show();
                });
                i--;
            }
        }
        else
        {
            progress.hide();
            btns.attr('disabled', false).prop('disabled', false);
            var html = 'لطفاً گزینه های ستاره دار را به درستی تکمیل نمائید.';
            wAlertMsg.html(html);
            wAlert.removeClass('').addClass('alert-warning').show();
        }

        return false; // for safety
    }
</script>