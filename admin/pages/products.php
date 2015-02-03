<?php
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Category.php");

$obj_cat = new Category();
$cats = $obj_cat->getAll();

$div_tabs = "";
$first = true;
$cat_id = "";

foreach ($cats as $cat) {

    if ($first) {

        $cat_id = $cat['id'];
        $first = false;
    }

    $div_tabs .= '<li><a href="#tab-' . $cat['id'] . '" style="font-size:12px" data-cat_id="' . $cat['id'] . '"> ' . $cat['cat_title'] . '</a> </li>';
}


?>
<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/products.js"></script>

    <style>

        body {
            background-color: lightgoldenrodyellow;
        }

        iframe {
            width: 100%;
            overflow: hidden;
            order: 0;
            border: 0;
            min-height: 400px;
        }

    </style>

</head>
<body>

<div style="width:100%;">
    <ul class="nav nav-tabs">
        <?php echo $div_tabs ?>
    </ul>

    <iframe src="/admin/backend/action_display_table.php?cat_id=<?php echo $cat_id ?>" name="tbl_iframe" id="tbl_iframe"
            seamless></iframe>

</div>
</body>
</html>