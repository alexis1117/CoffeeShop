<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Category.php";
include($_SERVER["DOCUMENT_ROOT"] . "/config/CONSTANTS.php");

$default_title = "";
$n_cart = "";

$usr_exists = "false";

if (isset($_COOKIE['usrlogin'])) {

    $default_title = "/images/menu_account.png";
    $usr_exists = "true";

} else {

    $default_title = "/images/menu_home.png";
}

if (isset($_COOKIE['n_cart'])) {

    $n_cart = "(" . $_COOKIE['n_cart'] . ")";

}

$cat_obj = new Category();
$cats = $cat_obj->getAll();

$menu = "";
foreach ($cats as $cat) {

    $cat_img = UPLOAD_DIR . explode(',', $cat['cat_img'])[0];
    $menu .= '
            <li data-img="' . $cat_img . '">
                <a href="./pages/content.php?categoryID=' . $cat['id'] . '" target="iframe_body" class="menu_item">' . strtoupper($cat['cat_title']) . '</a>
            </li>';
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php include "/config/head.php"; ?>

    <script type="text/javascript" src="/javascripts/index.js"></script>

    <link rel="stylesheet" href="/stylesheets/index.css">
    <link rel="stylesheet" href="/stylesheets/iframe.css">
    <link rel="stylesheet" href="/stylesheets/ui.css">

    <title>Prime Grind Coffee</title>

</head>
<body>
<label id="usr_exists" hidden="hidden"><?php echo $usr_exists ?></label>

<div class="container_body">

    <aside>
        <div class="container_logo">
            <img src="/images/logo.png"/>
        </div>
        <div class="container_mainmenu">
            <ul class="nav nav-pills nav-stacked">
                <li class="active" data-img="/images/menu_home.png"/>
                <a href="#">HOME</a>
                </li>

                <?php echo $menu ?>

                <li>
                    <a href="#" data-img="/images/menu_aboutus.png">ABOUT US</a>
                </li>
            </ul>
        </div>
    </aside>

    <section>
        <div class="container_top">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li>
                            <a><span class="glyphicon glyphicon-phone"></span>1-213-245-7487</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li id="link_signin" data-img="/images/menu_signin.png">
                            <a href="/pages/signin.php" target="iframe_body">
                                <span class="glyphicon glyphicon-user"></span> Sign In
                            </a>
                        </li>

                        <li id="link_account" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="/pages/account.php"
                               target="iframe_body">
                                <span class="glyphicon glyphicon-user"></span> My Account
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li data-img="/images/menu_account.png">
                                    <a href="/pages/account.php" target="iframe_body">
                                        <span class="glyphicon glyphicon-list-alt"></span> Past Orders
                                    </a>
                                </li>
                                <li data-img="/images/menu_account.png">
                                    <a href="/pages/settings.php" target="iframe_body">
                                        <span class="glyphicon glyphicon-wrench"></span> Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="" id="usr_signout">
                                        <span class="glyphicon glyphicon-log-out"></span> Sign Out
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li data-img="/images/menu_cart.png">
                            <a href="/pages/cart.php" target="iframe_body" id="usr_cart">
                                <span class="glyphicon glyphicon-shopping-cart"></span> My Cart <?php echo $n_cart ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container_title">
                <img src="<?php echo $default_title ?>"/>
            </div>

        </div>
        <div class="container_bottom">
            <iframe src="" name="iframe_body" id="iframe_body" class="iframe_body" seamless>
            </iframe>
        </div>
    </section>

</div>
</body>
</html>