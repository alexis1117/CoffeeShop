<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/javascripts/signin.js"></script>
    <link rel="stylesheet" type="text/css" href="/stylesheets/form.css">

    <style>
        body {
            background-color: #C6A76D;
            padding: 20px;
        }

        .container_body {
            display: flex;
            flex: 1;
            font-size: 12px;
        }

        h5 {
            margin: 20px;
            text-align: center;
            font-family: Arial, serif;
            font-weight: bold;
        }

        .container_signin, .container_signup {
            flex: 1;
            background-color: #ffffff;

            border: 1px #aec1ff solid;
            border-radius: 10px;

            margin: 10px;
            padding: 50px 20px;
        }

        .input_wrapper span {
            min-width: 60px;
        }

        .btn {
            float: right;
        }

    </style>

</head>
<body>

<div class="container_body">

    <div class="container_signin">
        <h5>Existing Customers</h5>

        <div class="alert alert-danger alert-error" hidden="hidden">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <span style="font-weight: bold">You have the following errors:</span>
            <ul style="padding-top: 10px"></ul>
        </div>

        <form id="form_signin" method="post">
            <div class="input_wrapper">
                <span>Email: </span>
                <input type="email" id="usr_email" placeholder="Enter email"
                       name="usr_email"/>
            </div>
            <div class="input_wrapper">
                <span>Password: </span>
                <input type="password" placeholder="Enter password" id="usr_pass"
                       name="usr_pass"/>
            </div>
            <input type="submit" value="Sign In" class="btn btn-primary"/>
        </form>

    </div>

    <div class="container_signup">

        <h5>New Customer <span class="glyphicon glyphicon-question-sign"></span></h5>

        <a href="/pages/signup.php" id="link_signup" data-img="../images/menu_signup.png" class="btn btn-primary">
            Continue <span class="glyphicon glyphicon-triangle-right"></span>
        </a>
    </div>
</div>


</body>
</html>