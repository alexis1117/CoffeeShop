<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/admin_settings.js"></script>

    <style>

        label {
            width: 150px;
            font-size: 12px;
        }

        .container {
            padding: 10px;
        }

    </style>
</head>
<body>
<div class="container">
    <form role="form" id="form_pwd">
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

        <div class="form-group form-inline">
            <label for="email">Old Password:</label>
            <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Enter password">
        </div>
        <div class="form-group form-inline">
            <label for="pwd">New Password:</label>
            <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Enter password">
        </div>
        <div class="form-group form-inline">
            <label for="pwd">Confirm New Password:</label>
            <input type="password" class="form-control" id="confirm_pass" name="confirm_pass"
                   placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
</div>


</body>
</html>