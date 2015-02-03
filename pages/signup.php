<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/javascripts/signup.js"></script>
    <link rel="stylesheet" type="text/css" href="/stylesheets/form.css">

    <style>

        body {
            background-color: #C6A76D;
            padding: 30px 100px;
        }

        .input_wrapper span {
            min-width: 130px;
        }

        .btn {
            min-width: 100px;
        }

    </style>

</head>
<body>

<div class="container_form">

    <form id="form_signup" method="post">

        <div class="alert alert-danger alert-error" hidden="hidden">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <span style="font-weight: bold">You have the following errors:</span>
            <ul style="padding-top: 10px"></ul>
        </div>

        <div class="input_wrapper">
            <span>Name: </span>
            <input type="text" id="usr_name" name="usr_name" placeholder="Enter name"/>
        </div>

        <div class="input_wrapper">
            <span>Email: </span>
            <input type="email" id="usr_email" name="usr_email" placeholder="Enter email"/>
        </div>

        <div class="input_wrapper">
            <span>Password: </span>
            <input type="password" id="usr_pass" name="usr_pass" placeholder="Enter password"/>
        </div>

        <div class="input_wrapper">
            <span>Confirm Password: </span>
            <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Confirm password"/>
        </div>

        <div class="input_wrapper">
            <span>Address: </span>
            <input type="text" id="usr_street" name="usr_street" placeholder="Enter street address"/>
        </div>

        <div class="input_wrapper">
            <span>Address(optional): </span>
            <input type="text" id="usr_street_optional" name="usr_street_optional"/>
        </div>

        <div class="input_wrapper">
            <span>Apt, Suit, Floor: </span>
            <input type="text" id="usr_apt" name="usr_apt" placeholder="Enter apt"/>
        </div>

        <div class="input_wrapper">
            <span>ZIP code: </span>
            <input type="text" id="usr_zip" name="usr_zip" placeholder="Enter zip"/>
        </div>

        <div class="input_wrapper">
            <span data-title="usr_phone">Phone: </span>
            <input type="text" id="usr_phone" name="usr_phone" placeholder="Enter phone"/>
        </div>


        <div class="container_button">
            <span>
                <input type="checkbox" id="email_list">
                Yes, I would like to receive emails with deals and discount
            </span>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
    </form>

</div>
</body>
</html>
