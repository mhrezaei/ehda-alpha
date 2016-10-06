<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <p style="color: #99C952; font-family: 'IRANSans', 'Tahoma'; font-size: 11px; text-align: center;"><?php echo pd(pdate('d F Y - H:i')); ?></p>
                <!--                <a href="#">-->
                <!--                    Start Bootstrap-->
                <!--                </a>-->
            </li>
            <li>
                <a href="#">
                    <div class="glyphicon glyphicon-home sidebarIcon"></div>
                    <div class=""><a href="<?php echo base_url('manage/home/index'); ?>">صفحه نخست</a></div>
                </a>
            </li>
            <li>
                <a href="#" class="haveChild">
                    <div class=" glyphicon glyphicon-list-alt sidebarIcon"></div>
                    <div class="">اخبار</div>
                </a>
                <ul class="sidebar-nav sidebar-child" style="display: none;">
                    <li>
                        <a href="#">
                            <div class="glyphicon glyphicon-pencil sidebarIcon"></div>
                            <div class=""><a href="<?php echo base_url('manage/home/addNews'); ?>"> افزودن خبر</a></div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="glyphicon glyphicon-list sidebarIcon"></div>
                            <div class=""><a href="<?php echo base_url('manage/home/manageNews'); ?>">لیست اخبار</a>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="haveChild">
                    <div class=" glyphicon glyphicon-user sidebarIcon"></div>
                    <div class="">کاربران</div>
                </a>
                <ul class="sidebar-nav sidebar-child" style="display: none;">
                    <li>
                        <a href="#">
                            <div class="glyphicon glyphicon-pencil sidebarIcon"></div>
                            <div class="">افزودن کاربر</div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="glyphicon glyphicon-list sidebarIcon"></div>
                            <div class="">لیست کاربران</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <div class="glyphicon glyphicon-user sidebarIcon"></div>
                    <div class="">سفیران</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="glyphicon glyphicon-file sidebarIcon"></div>
                    <div class="">صفحات اصلی</div>
                </a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->