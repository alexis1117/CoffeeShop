<?php

define ('SITE_ROOT', realpath(dirname(__FILE__)));

$targetPath = "";

if (isset($_FILES['img_to_upload']) && $_FILES['img_to_upload']['error'] == 0) {
    $targetPath = "/images/" . $_FILES['img_to_upload']['name'];

    if (isset($_FILES['img_to_upload']['type'])) {
        $valid_extensions = array("jpeg", "jpg", "png");
        $temp = explode(".", $_FILES['img_to_upload']['name']);
        $file_extension = end($temp);

        if ((($_FILES["img_to_upload"]["type"] == "image/png") || ($_FILES["img_to_upload"]["type"] == "image/jpg") || ($_FILES["img_to_upload"]["type"] == "image/jpeg")
        )
        ) {

            if ($_FILES["img_to_upload"]["error"] > 0) {
                //let the user know about the error
            } else {
                if (file_exists("/upload/" . $_FILES["img_to_upload"]["name"])) {
                    //let the user know the file exists already
                } else {
                    $sourcePath = $_FILES['img_to_upload']['tmp_name'];
                    $targetPath = "/images/" . $_FILES['img_to_upload']['name'];
                    move_uploaded_file($sourcePath, $targetPath);
                }
            }

        }
    };
}
?>
<html>
<style>
    img {
        height: 150px;
        width: 150px;
    }
</style>
<body>
<p><?php echo $targetPath ?></p>

<div>
    <img src="<?php echo $targetPath ?>">
</div>

</body>
</html>