<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Page</title>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <link rel="stylesheet" href="/admin/stylesheets/admin_login.css">

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="color: #ffffff">Prime Grind | Administration</a>
        </div>
    </div>
</nav>


<div class="the_body container">

    <div class="container_log">
        <div>
            <h5 style="text-align: center !important; font-weight: bold; color: #ffffff">
                <span class="glyphicon glyphicon-lock" style="color: #ffffff"></span>
                Please enter your login details.
            </h5>
        </div>
        <form method="post" name="admin_form">

            <div class="alert alert-danger alert-error" style="margin-left: 10px; margin-right: 10px" hidden="hidden">
                <span class="glyphicon glyphicon-warning-sign"></span>
                <strong>Error!</strong>
                <small>something something</small>
            </div>

            <div class="container_inside_form">

                <div class="container_outer_col1">
                    <img src="images/admin_lock.png"/>

                </div>
                <div class="container_outer_col2">
                    <div class="container_row">
                        <div class="container_col1">
                            <label>Admin ID</label>
                        </div>
                        <div class="container_col2">
                            <input type="text" class="form-control" placeholder="Enter ID" id="admin_id"
                                   name="admin_id"/>
                        </div>
                    </div>
                    <div class="container_row">
                        <div class="container_col1">
                            <label>Password</label>
                        </div>
                        <div class="container_col2">
                            <input type="password" class="form-control" placeholder="Enter password" id="admin_pass"
                                   name="admin_pass"/>
                        </div>
                    </div>
                    <div class="container_row">
                        <div class="container_col1">
                        </div>
                        <div class="container_col2">
                            <input type="submit" value="Log In" class="btn btn-primary""/>
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>
</div>

</body>
</html>