<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: left"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="font-family: 'webYekan';">ثبت نام کارت اهدای عضو</h4>
            </div>
            <form id="frmCardRegister" method="post" action="<?php echo base_url(); ?>ajax/ajax_conf/cardRegister" name="registerForm">
                <div class="modal-body" id="registerModalBody">
                    <?php registerForm(); ?>
                    <input type="hidden" id="txtExtraBirthday" name="txtExtraBirthday">
                </div>
                <div class="modal-footer taha" style="text-align: left;" id="firstFooter">
                    <button type="button" class="taha-doubleCheck btn btn-danger" id="btnEditData">اصلاح اطلاعات</button>
                    <button id="btnRegisterSubmit" type="submit" class="btn btn-success" >ارسال اطلاعات</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseModal">انصراف</button>
                </div>
                <div class="modal-footer taha" style="text-align: left; display: none;" id="lastFooter">
                    <a id="btnCardPrint" type="button" class="btn btn-success" target="_blank" >چاپ کارت اهدای عضو</a>
                    <a id="btnCardDownload" type="button" class="btn btn-info" target="_blank" >دانلود کارت اهدای عضو</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseModal">خروج</button>
                </div>
            </form> 
        </div>
    </div>
</div>