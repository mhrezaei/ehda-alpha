<script type="text/javascript">
    $(document).ready(function() {
        $('#fullpage').fullpage({
            verticalCentered: false,
            resize: true

        });
        $('#navA9').addClass("active");
    });
</script>

<style>

    /* Style for our header texts
    * --------------------------------------- */
    h1{
        background-color: #BABE40;
        font-family: 'IRANSans', 'Tahoma';
        color: #fff;
        padding: 10px;
        position: absolute;
        bottom: 30px;
        text-align: center;
        margin: 0 auto;
        margin-right: 30px;
        font-size: 2em;
        border-radius: 8px;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
    }


    /* Backgrounds will cover all the section
    * --------------------------------------- */
    .section{
        background-size: cover;
    }
    .slide{
        background-size: cover;
    }


    /*Adding background for the slides
   * --------------------------------------- */
    <?php for($i = 1; $i <= 21; $i++)
    {
        echo '#slide' . $i . '{
        background-image: url("' . asset_url() . 'images/slider/' . $i . '.jpg");
        padding: 0 0 0 0;
    }' . "\n";
    }
     ?>


    /* Bottom menu
    * --------------------------------------- */
    #infoMenu li a {
        color: #fff;
    }
</style>

<div id="fullpage">
    <div class="section">
        <?php for($a = 1; $a <= 21; $a++)
        {
            echo '<div class="slide" id="slide' . $a . '"><h1>جشن نفس ... جشن زندگی ...</h1></div>' . "\n";
        }
        ?>
    </div>

</div>