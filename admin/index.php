
<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/23/2015
 * Time: 10:41 AM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Order.php");

$obj_order = new Order();

$n_neworder = $obj_order->getByStatus("Preparing")->num_rows;

$n_pastorder = $obj_order->getAll()->num_rows - $n_neworder;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Page</title>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/index.js"></script>
    <link rel="stylesheet" href="stylesheets/index.css" type="text/css"/>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="color: #ffffff">Prime Grind | Administration</a>
        </div>
        <div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Logged in as: <span class="glyphicon glyphicon-user"></span> Admin</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="the_body">
    <aside>
        <div class="container_pill">
            <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <label>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                <span class="glyphicon glyphicon-triangle-right"></span> Admin Tools</a>
                        </label>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="/admin/pages/dashboard.php" target="admin_iframe">Dashboard</a></li>
                                <li><a href="#">Email</a></li>
                                <li><a href="/admin/pages/admin_settings.php" target="admin_iframe">Settings</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <label>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                <span class="glyphicon glyphicon-triangle-right"></span> Catalog</a>
                        </label>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="/admin/pages/categories.php" target="admin_iframe">Categories</a></li>
                                <li><a href="/admin/pages/products.php" target="admin_iframe">Products</a></li>
                                <li><a href="/admin/pages/extra.php" target="admin_iframe">Extra Products</a></li>
                                <li><a href="/admin/pages/size.php" target="admin_iframe">Product Size</a></li>
                                <li><a href="/admin/pages/settings.php" target="admin_iframe">Settings</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <label>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                <span class="glyphicon glyphicon-triangle-right"></span> Orders</a>
                        </label>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="/admin/backend/action_display_order.php?new" target="admin_iframe">
                                        New Order(s)
                                        <span class="badge n_neworder"><?php echo $n_neworder ?></span>
                                    </a>
                                </li>
                                <li><a href="/admin/pages/past_orders.php" target="admin_iframe">
                                        Past Order(s)
                                        <span class="badge n_pastorder"><?php echo $n_pastorder ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <label>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                <span class="glyphicon glyphicon-triangle-right"></span>Reports</a>
                        </label>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <section>
        <div class="container_section">
            <div class="section_heading bg-info">
                <label style="font-weight: bold">Dashboard </label>
            </div>

            <div style="padding-top: 10px">
                <div class="alert alert-info">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Notifications
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <ul>
                        <li>
                            <small style="color: #000000">You have <strong
                                    class="n_neworder"><?php echo $n_neworder ?></strong> new
                                order(s).
                            </small>
                        </li>
                        <li>
                            <small style="color: #000000">You have <strong>3</strong> new email(s).</small>
                        </li>
                    </ul>
                </div>
            </div>

            <iframe src="/admin/pages/dashboard.php" name="admin_iframe" id="admin_iframe" seamles></iframe>

        </div>

    </section>

</div>

</body>
</html>