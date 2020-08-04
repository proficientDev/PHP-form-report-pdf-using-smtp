<?php
    $page = $_GET['page'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jeffrey Turner">
    <title>Confirm</title>
    <style>
        html, body{
            width: 100%;
            height: 100vh;
        }
        .confirm {            
            position: absolute;
            width: 100%;
            height: 100%;
            top: 25%;
            text-align: center;
        }
        .message h1{
            font-size: 54px;
        }

        .message a{
            font-size: 22px;

        }
    </style>
</head>
<body>
    <div class="confirm">
        <div class="message">
            <?php
                if($page == "submitted"){
            ?>
                <h1>Your Request Has Been Sent To Your Supervisor!</h1>
            <?php } else { ?>
                <h1>The Request Has Been Approved!</h1>
            <?php }  ?>
            <a href="./index.php">Go to Request Forms</a>
        </div>
     </div>
</body>
</html>