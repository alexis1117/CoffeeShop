<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/24/2015
 * Time: 12:40 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Category.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Size.php");

if (isset($_GET)) {

    $cat_id = $_GET['cat_id'];

    $obj_cat = new Category();
    $obj_cat->__createByID($cat_id);

    $obj_sz = new Size();
    $sizes = $obj_sz->getAll();

    $size = "";

    foreach ($sizes as $sz) {
        $size .= '
                <span > ' . $sz['sz_title'] . ':
                    <input type = "text" class="form-control item_sz" data-sz_id ="' . $sz['id'] . '" placeholder = "Enter size" >
                </span >';
    }
}
?>
<html>
<head>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/new_product.js"></script>
    <script type="text/javascript" src="/admin/javascripts/file_upload.js"></script>

    <link rel="stylesheet" type="text/css" href="/admin/stylesheets/new_product.css">

</head>
<body>
<h5>Category: <span id="cat_id" data-cat_id="<?php echo $cat_id ?>"><?php echo $obj_cat->getTitle() ?></span></h5>

<form id="new_item">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/help_msg.php"); ?>

    <div class="container_new">
        <div class="hidden_div">
            <label>Title: </label>
            <label>Description: </label>
        </div>
        <div class="container_input">
            <input type="text" class="form-control" id="item_title" placeholder="Enter title"/>

            <div class="container_sz">
                <?php echo $size ?>
            </div>
            <textarea rows="5" class="form-control" id="item_desc" placeholder="Enter description"></textarea>

            <input type="file" id="fileupload" name="files[]"
                   data-url="/lib/jQuery-File-Upload-9.9.2/server/php/" multiple/>
            <ul></ul>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus" style="color: #ffffff"></span> add
            </button>

        </div>
    </div>
</form>
</body>
</html>