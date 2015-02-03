<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/31/2015
 * Time: 2:56 AM
 */
?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/javascripts/update_pwd.js"></script>
    <link rel="stylesheet" type="text/css" href="/stylesheets/form.css">


    <style>

        .input_wrapper span {
            min-width: 120px;
        }

        .hidden_div {
            height: 60px;
        }

        .container_form {
            border: none;
        }

    </style>

</head>
<body>

<div class="container_form">

    <form id="form_pwd">

        <div class="hidden_div">

        </div>

        <div class="alert alert-danger alert-error" hidden="hidden">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <span style="font-weight: bold">You have the following errors:</span>
            <ul style="padding-top: 10px"></ul>
        </div>
        <div class="alert alert-success" hidden="hidden">
            <span class="glyphicon glyphicon-thumbs-up"></span>
            <span style="font-weight: bold">Success: </span>
            <span>Password updated successfully.</span>
        </div>

        <div class="input_wrapper">
            <span>Old Password: </span>
            <input type="password" id="old_pass" name="old_pass" placeholder="Enter password"/>
        </div>

        <div class="input_wrapper">
            <span>New Password: </span>
            <input type="password" id="new_pass" name="new_pass" placeholder="Enter password"/>
        </div>

        <div class="input_wrapper">
            <span>Confirm Password: </span>
            <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Enter password"/>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>