<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        #btn_close {
            position: absolute;
            right: 2%;
            color: #5F310F;
        }

        :focus {
            outline: none !important;
        }

        .container_img img {
            position: absolute;
            left: 7%;
            top: 20%;

            width: 220px;
            height: 250px;

            border: 1px solid #5F310F;
            border-radius: 15px;

            box-shadow: 0px 0px 20px 5px rgba(95, 49, 15, 0.94);
        }

        #item_size, #add_to_cart {
            width: 100%;
            font-size: 12px;
            background-color: #5F310F;;
            height: 25px;
            color: #C6A76D;
        }

        label {
            font-size: 14px;
            color: #5F310F;
            font-family: Arial, serif;
            margin-top: 15px;
        }

        span {
            font-size: 10px;
        }

        #desc {
            width: 100%;
            margin-top: 5px;
            font-size: 10px;
            height: 50px;
            padding: 5px;
            border: 1px solid #CAB286;

            border-radius: 5px;
        }

        #table_checklist {
            position: relative;
            width: 100%;
            font-size: 10px;
        }

        .ext_price {
            position: absolute;
            background-color: #5F310F;;
            padding: 5px;
            border-radius: 5px;
            margin-left: 20%;
            margin-top: -7%;
        }

        .ext_price span {
            /*color: #C6A76D;*/
            color: #ffffff;
            font-size: 12px;
        }

        .btn, .btn:focus, .btn:active, .btn.active, .open .dropdown-toggle.btn {
            color: #C6A76D;
            background-color: #5F310F;
            border: none;
            padding: 2px;
            width: 25px;
            height: 25px;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: saddlebrown;
            border-color: #ffffff;
            color: #C6A76D;
        }

        .detail_qty {
            width: 25px;
            height: 25px;
            color: #C6A76D;
            text-align: center;

            background-color: #5F310F;
            border: none;

            margin-left: 2px;
            margin-right: 2px;

            border-radius: 5px;
        }

        .container_detail {
            display: flex;
            flex: 1;
            flex-direction: row;
            padding: 5px;
        }

        .container_img {
            flex: 1;
            justify-content: center;
            padding: 10px;
        }

        .container_side {
            display: flex;
            flex: 1;
            flex-direction: column;
        }

        .row {
            display: flex;
            flex: 1;
            flex-direction: row;
            padding-left: 15px;
        }

    </style>
</head>
<body>

<a href="#" id="btn_close">
    <span class="glyphicon glyphicon-remove-circle" style="font-size: 18px"></span>
</a>

<div class="container_detail">
    <div class="container_img">
        <div class="img_wrapper">
            <img id="detail_img" src=""/>
        </div>
    </div>
    <div class="container_side">
        <form action="" method="post">

            <div class="row">
                <label id="detail_title"></label>
            </div>

            <div class="row">
                <label id="detail_price" data-size_id="-1"></label>
            </div>

            <div id="detail_size"></div>

            <div class="row">
                <label>Qty</label>

                <button type="button" id="dec_qty" class="btn btn-info detail_qty">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>

                <label for="item_qty">
                    <input id="item_qty" class="detail_qty" type="text" value="1" readonly/>
                </label>

                <button type="button" id="inc_qty" class="btn btn-info detail_qty">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>

            <label>Extras</label>

            <div id="detail_extra"></div>

            <label>Details</label>

            <div id="desc">
                <p id="detail_desc"></p>
            </div>

            <button id="add_to_cart" type="button" class="btn btn-default btn-sm" data-item_id="">
                <span class="glyphicon glyphicon-shopping-cart"></span> add to cart
            </button>
        </form>
    </div>
</div>
</body>
</html>