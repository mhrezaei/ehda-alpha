<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    //==========================================================================================
    function registerForm()
    {
        //Preparetions...

        //Showing...
    ?>
    <div class="form-horizontal">

        <?php
            registerForm_input("txtName"		, "نام"					, array("required"=>true    ));
            registerForm_input("txtFam"			, "نام خانوادگی"		, array("required"=>true    ));
            registerForm_gender();
            registerForm_input("txtFather"		, "نام پدر"				, array("required"=>true    ));
            registerForm_input("txtShenas"		, "شماره‌ی شناسنامه"	, array("required"=>true    ));
            registerForm_input("txtMelli"		, "کد ملی"				, array("required"=>true    , "hint"=>"عدد ده رقمی کد ملی خود را بدون فاصله و کاراکتر اضافه وارد کنید: مثلاً: 0071234567", 'maxlength' => 10));
            registerForm_input("txtBirthday"	, "تاریخ تولد"			, array("required"=>true    , "hint"=>"تاریخی که وارد می‌کنید را فوراً به شکل صحیح درخواهیم آورد ولی برای راحتی خودتان، از جدول درج خودکار استفاده کنید. مثلاً 1365/8/1" , "class"=>"pdate"));
            registerForm_input("txtBirthCity"	, "محل تولد"			, array("required"=>true    ));
            registerForm_edu();
            registerForm_input("txtJob"			, "شغل"					, array("required"=>false    ));
            registerForm_input("txtMob"			, "تلفن همراه"			, array("required"=>true    , "hint"=>"مثلاً: 09351234567", 'maxlength' => 11));
            registerForm_input("txtTel"			, "تلفن ثابت"			, array("required"=>true    , "hint"=>"پیش‌شماره‌ی شهرتان را هم قید کنید. مثلاً: 0212233444", 'maxlength' => 11));
            registerForm_state();
            registerForm_city();
            registerForm_input("txtEmail"		, "نشانی ایمیل"			, array("required"=>false    , "dir"=>"ltr"));
            registerForm_input("txtUsername"	, "نام کاربری"			, array("required"=>true    , "dir"=>"ltr" , "hint"=>"از الفبای انگلیسی استفاده کنید."));
            registerForm_input("txtPass1"		, "کلمه عبور"			, array("required"=>true , "dir"=>"ltr" , "password"=>1));
            registerForm_input("txtPass2"		, "تکرار کلمه عبور"		, array("required"=>true , "dir"=>"ltr" , "password"=>1));
            registerForm_selector();
            registerForm_doubleCheck() ; 

        ?>

        <div id="divFormFeed" class="taha"></div>

    </div>
    <?php
    }

    //-------------------------------------------------------------------------
    function registerForm_control_up($data=array())
    {
        //Preparetions...
        if(isset($data['required']) AND $data['required'])
            $requiredShow    = "block"    ;
        else
            $requiredShow    = "none"    ;


        //Showing...
    ?>
    <div class="form-group taha">
        <div class="col-sm-1">
            <label class="glyphicon glyphicon-star taha-formRequired" style="display: <?php echo $requiredShow; ?>;" title="تکمیل الزامی" ></label>
        </div>
        <div class="col-sm-9">
            <?php
            }

            //-------------------------------------------------------------------------
            function registerForm_control_down($name,$caption,$data=array())
            {        
                //Preparetions...
                if(isset($data['hint']))
                    $displayHint    = "block" ;
                else
                {
                    $displayHint    = "none" ;
                    $data['hint'] = '';
                }



                //Showing...
            ?>
            <div id="spn-doubleCheck-<?php echo $name ; ?>" class="formRegister-doubleCheck taha"></div>
        </div>
        <label class="col-sm-2 control-label" style="text-align: left;" for="<?php echo $name; ?>">
            <?php echo $caption; ?>
        </label>
    </div> 
    <div class="form-group taha" style="display: <?php echo $displayHint; ?>;">
        <div class="col-sm-1"></div>
        <div class="col-sm-9 taha-formHint">
            <?php echo $data['hint']; ?>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <?php

    }

    //-------------------------------------------------------------------------
    function registerForm_input($name,$caption,$data=array())
    {
        //Preparetions...
        if(isset($data['dir']))
            $dir = $data['dir'] ;
        else
            $dir = "rtl";
        if(!isset($data['class']))
            $data['class'] = NULL ;
            
        if(!isset($data['maxlength']))
            $data['maxlength'] = NULL ; 

        $placeHolder = NULL ; 

        if(isset($data['password']))
            $type = "password" ; 
        else
            $type = "input" ;   

        //Showing...
        registerForm_control_up($data);
    ?>
    <input id="<?php echo $name; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>" class="form-control formRegister-inputs <?php echo $data['class']; ?>" style="direction:<?php echo $dir;  ?>" value="" placeholder="<?php echo $placeHolder; ?>" maxlength="<?php echo $data['maxlength']; ?>" />
    <?php
        registerForm_control_down($name,$caption,$data);

    }

    //-------------------------------------------------------------------------
    function registerForm_gender()
    {
        registerForm_control_up(array("required"=>1));
    ?>
    <select name="cmbGender" class="form-control formRegister-inputs" style="padding:0 5px" >
        <option value="0" >انتخاب کنید...</option>
        <option value="2" >خانم</option>
        <option value="1" >آقا</option>
    </select>
    <?php
        registerForm_control_down("cmbGender","جنسیت",NULL);

    }

    //-------------------------------------------------------------------------
    function registerForm_edu()
    {
        registerForm_control_up(array("required"=>0));

    ?>
    <select id="cmbEducation" name="cmbEducation" class="form-control formRegister-inputs" style="padding:0 5px" >
        <option value="0">انتخاب کنید...</option>
        <option value="1">زیر دیپلم</option>
        <option value="2">دیپلم</option>
        <option value="3">کاردانی</option>
        <option value="4">کارشناسی</option>
        <option value="5">کارشناسی‌ارشد</option>
        <option value="6">دکترا و بالاتر</option>
    </select>
    <?php
        registerForm_control_down("cmbEducation","میزان تحصیلات",NULL);

    }

    //-------------------------------------------------------------------------
    function registerForm_selector()
    {
    ?>
    <div class="taha" style="padding: 20px;">
    مایلم اعضا و بافت‌های زیر را در زمان مرگم به بیماران نیازمند پیوند عضو، اهدا کنم.
    </div>

    <div id="divFormRegister-checks" class="formRegister-doubleCheck taha" style="border: 0;text-align: center;"></div>
    <div class="row formRegister-inputs taha">
        <div class="col-sm-2">&nbsp;</div>
        <div class="checkbox col-sm-1">
            <input name="chkTissues" type="checkbox" id="chkTissues">
            <label class="checkbox" style="padding: 0 20px;" for="chkTissues">نسوج</label>
            </input>          
        </div>
        <div class="checkbox col-sm-1">
            <input name="chkPancreas" type="checkbox" id="chkPancreas">
            <label style="padding: 0 20px;" for="chkPancreas">پانکراس</label>
            </input>          
        </div>
        <div class="checkbox col-sm-1">
            <input name="chkKidney" type="checkbox" id="chkKidney">
            <label style="padding: 0 20px;" for="chkKidney">کلیه</label>
            </input>          
        </div>
        <div class="checkbox col-sm-1">
            <input name="chkLung" type="checkbox" id="chkLung">
            <label style="padding: 0 20px;" for="chkLung">ریه</label>
            </input>          
        </div>
        <div class="checkbox col-sm-1">
            <input name="chkLiver" type="checkbox" id="chkLiver">
            <label style="padding: 0 20px;" for="chkLiver">کبد</label>
            </input>          
        </div>
        <div class="checkbox col-sm-1">
            <input name="chkHeart" type="checkbox" id="chkHeart">
            <label style="padding: 0 20px;" for="chkHeart">قلب</label>
            </input>          
        </div>
        <div class="checkbox col-sm-4">
            <input name="chkAll" type="checkbox" id="chkAll">
            <label style="padding: 0 20px;" for="chkAll">همه‌ی اعضا و نسوج قابل اهدا</label>
            </input>          
        </div>
        <div class="col-sm-2">&nbsp;</div>
    </div>

    <?php

        return ;

    }


    //-------------------------------------------------------------------------
    function registerForm_state()
    {
        //Preparetions...


        //Showing...
        registerForm_control_up(array("required"=>true));
    ?>
    <select name="txtState" id="txtState" class="form-control formRegister-inputs" style="padding:0 5px" onchange="insertcity('txtCity', 'txtState', false);" >

    </select>
    <?php
        registerForm_control_down("txtState","استان",NULL);

    }


    //-------------------------------------------------------------------------
    function registerForm_city()
    {
        //Preparetions...


        //Showing...
        registerForm_control_up(array("required"=>true));
    ?>
    <select name="txtCity" id="txtCity" class="form-control formRegister-inputs" style="padding:0 5px" disabled="disabled" >

    </select>
    <?php
        registerForm_control_down("txtCity","شهر",NULL);

    }

    //-------------------------------------------------------------------------
    function registerForm_doubleCheck()
    {
        //Showing...
    ?>
    <div class="taha-doubleCheck alert alert-info taha">
        همه‌چیز برای ثبت‌نام شما و چاپ کارت اهدای عضوتان آماده است.
        <br />
        برای اطمینان، یک بار دیگر اطلاعات خود را بازبینی کنید و سپس دکمه‌ی «ارسال اطلاعات» را دوباره فشار دهید.
    </div>
    <input type="hidden" id="txtDoubleCheck" name="txtDoubleCheck" value="0" />

    <!--			<label onclick="doubleCheck()">+</label>
    <label onclick="$('#frmCardRegister :input').val('1')">++</label>
    -->
    <?php

    }


?>