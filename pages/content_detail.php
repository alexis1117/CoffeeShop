<html>
<head>

    <style>

        table {
            position: relative;
        }

        #btn_close {
            position: absolute;
            right: 2%;
            color: #5F310F;;
        }

        :focus {
            outline: none !important;
        }

        .img_wrapper {
            display: flex;
            flex: 1;
            justify-content: center;
            padding: 20px;
        }

        #detail_img {
            width: 220px;
            height: 250px;

            border-radius: 15px;
            border: 1px solid #5F310F;

            box-shadow: 0px 0px 20px 5px rgba(95, 49, 15, 0.94);
        }

        #table_side_detail, #item_size, #add_to_cart {
            width: 100%;
            font-size: 12px;
        }

        #item_size {
            background-color: #5F310F;;
            height: 25px;
            color: #C6A76D;
        }

        #table_side_detail tr > td {
            padding-bottom: 10px;
        }

        #table_side_detail .caption, #detail_title, #detail_price {
            font-weight: bold;
            font-family: Arial, serif;
            color: #5F310F;

        }

        #detail_title, #detail_price {
            font-size: 15px;
            color: #5F310F;
            font-weight: bold;

        }

        #desc {
            width: 100%;
            margin-top: 5px;
            font-size: 10px;
            height: 50px;
            padding: 5px;
            border: 1px solid #CAB286;

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        #table_checklist {
            width: 100%;
            margin-top: 5px;
            font-size: 8px;
            padding-left: 10px;
        }

        .ext_price {
            background-color: #5F310F;;
            position: absolute;

            font-size: 12px;
            padding: 5px;
            /*color: #C6A76D;*/
            color: white !important;

            border-radius: 5px;
        }

        .btn, .btn:focus, .btn:active, .btn.active, .open .dropdown-toggle.btn {
            color: #C6A76D;
            background-color: #5F310F;
            border: none;
            padding: 2px;
            width: 25px;
            height: 25px;
        }

        .btn:hover {
            background-color: saddlebrown;
            border-color: #ffffff;
            color: #C6A76D;
        }

        input.detail_qty {
            width: 25px;
            height: 25px;
            color: #C6A76D;
            text-align: center;

            background-color: #5F310F;
            border: none;

            padding: 2px;

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

    </style>
</head>
<body>

<a href="#" id="btn_close">
    <span class="glyphicon glyphicon-remove-circle"></span>
</a>

<table>
    <tr>
        <td>
            <div class="image_wrapper">
                <img id="detail_img" src=""/>
            </div>
        </td>
        <td id="side_detail">
            <form action="" method="post">
                <table id="table_side_detail">
                    <tr>
                        <td>
                            <label id="detail_title"></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="detail_price" data-size_id="-1"></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="detail_size"></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="caption">Qty</label>

                            <button type="button" id="dec_qty" class="btn btn-info">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                            <label for="item_qty">
                                <input id="item_qty" class="detail_qty" type="text" value="1" readonly
                                       style="height: 25px; width: 25px"/>
                            </label>
                            <button type="button" id="inc_qty" class="btn btn-info">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="detail_extra" class="caption">Extras</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="caption">Details</label>

                            <div id="desc">
                                <p id="detail_desc"></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="add_to_cart">
                            <button id="add_to_cart" type="button" class="btn btn-default btn-sm" data-item_id="">
                                <span class="glyphicon glyphicon-shopping-cart"></span> add to cart
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
</body>
</html>