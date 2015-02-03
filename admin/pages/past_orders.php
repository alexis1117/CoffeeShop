<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/order.js"></script>

    <link rel="stylesheet" type="text/css" href="/admin/stylesheets/past_orders.css">

</head>
<body>
<form id="form_search">
    <div class="container_search">

        <select class="btn btn-primary" name="search_by">
            <option value="order_id">Order ID</option>
            <option value="usr_email">User Email</option>
        </select>
        <input type="text" class="form-control" placeholder="Search text" name="txt_search"/>
        <button type="submit" class="btn btn-primary">Search</button>

    </div>
</form>
<form id="form_filter">
    <div class="container container_filter">
        <div>
            <div class="col-sm-6">
                <span>Orders From/On:</span> <input type="text"
                                                    class="form-control datepicker text-primary"
                                                    name="start_date" placeholder="mm/dd/yyyy"/>
            </div>
            <div class="col-sm-6">
                <span>Orders Till:</span> <input type="text" class="form-control datepicker text-primary"
                                                 name="end_date"
                                                 placeholder="mm/dd/yyyy"/>
            </div>

        </div>
        <div>
            <div class="checkbox col-sm-6">
                <label><input type="checkbox" value="">Order Status</label>
                <select multiple class="form-control" name="sel_status" disabled>
                    <option>Completed</option>
                    <option>Unauthorized</option>
                    <option>Cancelled</option>
                </select>

            </div>
            <div class="checkbox col-sm-6" style="margin-top: 10px">
                <label><input type="checkbox" value="">Payment Type</label>
                <select multiple class="form-control" name="sel_payment" disabled>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Paypal">Paypal</option>
                </select>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary" style="float: right">
                Go<span class="glyphicon glyphicon-menu-right"></span>
            </button>
        </div>
    </div>
</form>
<iframe src="/admin/backend/action_display_order.php" name="order_iframe" id="order_iframe" seamless></iframe>

</body>
</html>