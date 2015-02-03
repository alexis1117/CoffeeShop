<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/25/2015
 * Time: 11:21 AM
 */

include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Usr.php");

$sel_status = "<select class='btn btn-primary status_select'>
                <option selected value='Preparing'>Preparing</option>
                <option value='Completed'>Completed</option>
                <option value='Cancelled'>Cancelled</option>
                <option value='Cancelled'>Cancelled</option>
                <option value='Unauthorized'>Unauthorized</option>
            </select>";


if (isset($_GET['new']))

    $result_orders = $db->query("SELECT * FROM tbl_order WHERE order_status = 'Preparing'");

else
    $result_orders = $db->query("SELECT * FROM tbl_order WHERE order_status != 'Preparing'");

$TRs = "";

if (isset($_POST)) {

    if (isset($_POST['search_by'])) {
        $search_by = $_POST['search_by'];
        $txt_search = preg_replace('/\s+/', '', $_POST['txt_search']);

        if ($search_by == "usr_email") {

            $result_orders = $db->query("SELECT * FROM tbl_order WHERE usr_email = '$txt_search'");

        } else if ($search_by == "order_id") {

            $result_orders = $db->query("SELECT * FROM tbl_order WHERE order_id = '$txt_search'");
        }
    } else if (isset($_POST['start_date'])) {

        date_default_timezone_set('America/Los_Angeles');
        $start_date = "";
        $end_date = "";


        if (strlen($_POST['start_date']) != 0) {
            $start_date = date('Y-m-d H:i:s', strtotime($_POST['start_date']));

        } else {
            $start_date = date('Y-m-d H:i:s', strtotime("2015-01-01"));
        }

        if (strlen($_POST['end_date']) != 0) {
            $end_date = date('Y-m-d H:i:s', strtotime($_POST['end_date']));
        } else {
            $end_date = date('Y-m-d H:i:s');
        }

        $WHERE_STATEMENT = "";

        if (isset($_POST['sel_status'])) {

            $order_status = $_POST['sel_status'];
            $WHERE_STATEMENT .= " AND order_status = '$order_status'";
        }

        if (isset($_POST['sel_payment'])) {

            $payment_type = $_POST['sel_payment'];
            $WHERE_STATEMENT .= " AND payment_type = '$payment_type'";
        }

        $result_orders = $db->query("SELECT * FROM tbl_order
                                      WHERE order_date BETWEEN '$start_date'
                                      AND '$end_date' AND order_status != 'Preparing' $WHERE_STATEMENT");
        echo mysqli_error($db);
    }
}

$n_order = $result_orders->num_rows;

for ($i = $result_orders->num_rows - 1; $i >= 0; $i--) {
    $result_orders->data_seek($i);
    $order = $result_orders->fetch_assoc();

    $order_id = $order['order_id'];

    $usr = new Usr();
    $usr->__createBy($order['usr_email']);
    $name = $usr->getUsrName();

    $type = $order['order_type'];
    $payment_type = $order['payment_type'];
    $date = $order['order_date'];
    $status = $order['order_status'];

    $TRs .= "<tr>";
    $TRs .= "<td>$order_id</td>";
    $TRs .= "<td>$name</td>";
    $TRs .= "<td>$type</td>";
    $TRs .= "<td>$payment_type</td>";
    $TRs .= "<td>$date</td>";
    if ($status == "Preparing") {
        $TRs .= "<td id='is_select'>$sel_status</td>";
    } else if ($status == "Completed") {
        $TRs .= "<td class='text-success'><span class='glyphicon glyphicon-ok-circle'></span> $status</td>";
    } else {
        $TRs .= "<td class='text-danger'><span class='glyphicon glyphicon-remove-circle'></span> $status</td>";
    }
    $TRs .= "<td><button class='btn btn-primary detail' id='#detail'>
                <span class='glyphicon glyphicon-list-alt'></span></button></td>";
    $TRs .= "</tr>";
}
?>

<html>
<head>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/display_order.js"></script>

    <style>
        table, .status_select {
            font-size: 12px;
        }

        .btn {
            padding-top: 2px !important;
            padding-bottom: 2px !important;
        }
    </style>
</head>
<body>
<?php if ($n_order != 0) { ?>
    <div>
        <table class="table table-hover">
            <thead>
            <tr class="" style="background-color: #337ab7; color: #ffffff">
                <th>Order ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Payment</th>
                <th>Date</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
            </thead>
            <tbody>
            <?php echo $TRs ?>
            </tbody>
        </table>
    </div>
    <?php
    if (isset($_GET['new'])) {
        echo '
            <div>
                <button class="btn btn-primary" id="update" style="float: right">
                    <span class=" glyphicon glyphicon-save"></span> update
                </button>
            </div>';
    }
    ?>

<?php } ?>


</body>
</html>

