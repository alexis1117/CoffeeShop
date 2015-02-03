<html>
<head>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/file_upload.js"></script>

    <style>
        .bar {
            height: 12px;
            background-color: #337ab7;
            margin-bottom: 30px;
        }

        ul {
            list-style: none;
        }

        .glyphicon-remove {
            color: darkred;
            cursor: pointer;
        }

        .glyphicon-remove:hover {
            color: #ff0000;
        }

        body {
            position: relative;
        }
    </style>
</head>
<body style="padding: 20px">

<input type="file" id="fileupload" name="files[]"
       data-url="/lib/jQuery-File-Upload-9.9.2/server/php/" multiple/>
<ul></ul>

<div id="progress">
    <div class="bar" style="width: 0%;"></div>
</div>

</body>
</html>