<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/9/2015
 * Time: 3:38 PM
 */

include $_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Usr.php";

$usr = new Usr();

$array_address = explode(',', $usr->getUsrAddress());

$email = $usr->getUsrEmail();
$name = $usr->getUsrName();
$phone = $usr->getUsrPhone();
$email_list = $usr->getEmailList();
$street = $array_address[0];
$apt = preg_replace('/\s+/', '', $array_address[1]);
$zip = preg_replace('/\s+/', '', $array_address[2]);

?>

<html>
<head>

    <?php include $_SERVER["DOCUMENT_ROOT"] . "/config/head.php"; ?>
    <script type="text/javascript" src="/javascripts/settings.js"></script>
    <link rel="stylesheet" type="text/css" href="/stylesheets/form.css">
    <link rel="stylesheet"type="text/css" href="/stylesheets/settings.css">

</head>
<body>

<div class="container_form">

    <form id=form_settings>

        <div class="alert alert-success" hidden="hidden">
            <span class="glyphicon glyphicon-thumbs-up"></span>
            <span style="font-weight: bold">Success: </span>
            <span>Content updated successfully.</span>
        </div>

        <div class="alert alert-danger alert-error" hidden="hidden">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <span style="font-weight: bold">You have the following errors:</span>
            <ul style="padding-top: 10px"></ul>
        </div>

        <h5>Information</h5>

        <div class="container_row">
            <div class="input_wrapper">
                <img src="/images/user_account.png">
                <span id="usr_email"><?php echo $email ?> </span>
            </div>
            <a href="" class="btn btn-primary">Change Password</a>
        </div>

        <div class="container_row">
            <div class="input_wrapper">
                <span>Name: </span>
                <input type="text" id="usr_name" name="usr_name" value="<?php echo $name ?>">
            </div>

            <div class="input_wrapper">
                <span>Phone: </span>
                <input type="text" id="usr_phone" name="usr_phone" value="<?php echo $phone ?>">
            </div>
        </div>

        <h5>Address</h5>

        <div class="container_row">
            <div class="input_wrapper">
                <span>Street: </span>
                <input type="text" id="usr_street" name="usr_street" value="<?php echo $street ?>">
            </div>

            <div class="input_wrapper">
                <span>(Optional): </span>
                <input type="text" id="usr_street" name="usr_street" value="<?php echo $street ?>">
            </div>
        </div>

        <div class="container_row">
            <div class="input_wrapper">
                <span>Apt/Floor: </span>
                <input type="text" id="usr_apt" name="usr_apt" value="<?php echo $apt ?>">
            </div>

            <div class="input_wrapper">
                <span>Zip code: </span>
                <input type="text" id="usr_zip" name="usr_zip" value="<?php echo $zip ?>">
            </div>
        </div>

        <div class="container_button">
            <span>
            <input type="checkbox" id="email_list" <?php if ($email_list == 1) echo "checked" ?>>
                Yes, I would like to receive emails with deals and discount
            </span>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

</div>
</body>
</html>
