<div class="section " id="section2">
    <div class="intro">
        <div class="container">
            <div class="col-md-12 ehdaCardTitle" style="margin-top: 5em; color: #ffffff;">
                <h2>فرشتگان ماندگار</h2>
            </div>

            <div class="col-md-12" id="ehdaCardContent">

                <div class="row ehdaCardP" style="font-family: 'IRANSans', 'Tahoma'; font-style: normal; font-size: 15px;">

                    <?php
                    if($angels)
                    {
                        for($i = 0; $i < 5; $i++)
                        {
                            echo '<div class="row" style="margin-top: 15px;">';
                            for($a = $i*12; $a < $i*12+12; $a++)
                            {
                                echo '<div class="col-md-1" style="min-width: 60px; max-width: 128px;"><img src="' . asset_url() . 'images/fereshteha/' . $angels[$a]['pic'] . '" class="img-circle angelsPic" data-toggle="tooltip" data-placement="top" title="' . $angels[$a]['name'] . '" /></div>';
                            }
                            echo '</div>';
                        }
                    }
                    ?>

                </div>

            </div>

        </div>
        <div style="clear: both; margin-top: 30px;"></div>

    </div>
</div>