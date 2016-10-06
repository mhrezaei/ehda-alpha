<script type="text/javascript">
    $(document).ready(function() {
        window.last = 0;
        $('#fullpage').fullpage({
            anchors: ['home', 'organ_donate_card','angels' , 'about', 'safiran' ,'partnership', 'contact'],
            sectionsColor: ['#77B1BC', '#C6AC8A','#F29D35' , '#1FC7C0','#2B7F0A' ,'#C6AC8A' , '#D2D2D2'],
            navigation: false,
            navigationPosition: 'right',
            navigationTooltips: ['صفحه نخست', 'کارت اهدای عضو','فرشتگان ماندگار' , 'درباره ما','سفیران'  ,'مشارکت' , 'تماس باما'],
            easingcss3: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
            loopTop: false,
            loopBottom: false,
            scrollingSpeed: 700,
            scrollOverflow: false,
            afterLoad: function(anchorLink, index){
                $('ul.nav > li').removeClass("active");
                $('#navA'+index).addClass("active");
                if(index == 1)
                {
                    $('.navbar').fadeOut(300, function(){
                        $(this).removeClass('navbar-fixed-top').addClass('navbar-fixed-bottom').fadeIn(300);
                    });
                }
                else
                {
                    if(window.last == 1)
                    {
                        $('.navbar').fadeOut(300, function(){
                            $(this).removeClass('navbar-fixed-bottom').addClass('navbar-fixed-top').fadeIn(300);
                        });
                    }
                }
            },
            onLeave: function(index, direction){
                window.last = index;
            },
            css3: true,
            fitToSection: false,
            autoScrolling: false,
            afterRender: function (index) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>

<style>

    /* Centered texts in each section
    * --------------------------------------- */
    .section{
        text-align:center;
    }

    /* Overwriting styles for control arrows for slides
    * --------------------------------------- */
    .controlArrow.prev {
        left: 50px;
    }
    .controlArrow.next{
        right: 50px;
    }


    /* Bottom menu
    * --------------------------------------- */
    #infoMenu li a {
        color: #fff;
    }
</style>

<div id="fullpage">
    <?php
    $this->load->view('OnePage_template/onePage_index'); // load page index
    $this->load->view('OnePage_template/onePage_ehdaCard'); // load page ehda Card
    $this->load->view('OnePage_template/onePage_angels'); // load page about
    $this->load->view('OnePage_template/onePage_about'); // load page about
    $this->load->view('OnePage_template/onePage_safiran'); // load page safiran
    $this->load->view('OnePage_template/onePage_partnership'); // load page partnership
    $this->load->view('OnePage_template/onePage_contact'); // load page contact
    ?>

</div>


<div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade in" id="myModalNews" style="display: none;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 id="myModalLabel" class="modal-title" style="font-family: 'IRANSans', tahoma;">اعلانات</h4>
            </div>
            <div class="modal-body" style="font-family: 'IRANSans', tahoma; text-align: justify;">
                سرورمکرم،
                <br>
                استاد فرهیخته جناب آقای دکتر نوبخت
                <br>
                سلام علیکم بما صبرتم، فنعم الدار هم اینک خبرمولمه رحلت متعلقه محترمه واصل وموجب تاسف گردید. ضمن عرض مراتب تسلیت از محضر حق متعال غفران ورحمت واسعه جهت فقیده سعیده وصبر جمیل قرین اجر جزیل برای آن عزیز سترک و سایر ارباب مصیبت مسالت دارد، ایام عزت مستدام باد.
                <br>
                حجت الاسلام و المسلمین مصطفی مرسلی
                <br>
                <a href="http://aftabnews.ir/fa/news/341767" target="_blank">لینک خبر</a>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button" style="font-family: 'IRANSans', tahoma;">خروج</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //$('#myModalNews').modal({show : true});
    });
</script>