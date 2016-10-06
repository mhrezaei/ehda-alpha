<html>
<head>
    <style rel="stylesheet" type="text/css">
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
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
</head>
<body>
<div class="book">

    <?php

        $count = 1;
        if(is_array($id))
        {
            $count = ceil(count($id) / 8);
        }

    $a = 0;
    for($i = 0; $i < $count; $i++)
    {
        if(is_array($id))
        {
            $s = '';
            for($b = 1; $b <= 8; $b++)
            {
                if(isset($id[$a]))
                {
                    if($b != 8)
                    {
                        if(isset($id[$a+1]))
                        {
                            $s .= $id[$a] . ',';
                        }
                        else
                        {
                            $s .= $id[$a];
                        }
                    }
                    else
                    {
                        $s .= $id[$a];
                    }
                }
                $a++;
            }
            echo '<img src="'. base_url("cardManagement/ehda_card/printGroup?id=" . $s) . '" style="width: 210mm; height: 297mm; margin-bottom: 5mm;">';
        }
        else
        {
            echo '<img src="'. base_url("cardManagement/ehda_card/printGroup?id=" . $id) . '" style="width: 210mm; height: 297mm; margin-bottom: 5mm;">';
        }
    }

    ?>
</div>
</body>
</html>

