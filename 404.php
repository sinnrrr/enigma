<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oops.. 404</title>
</head>
<body>
<!---->
<section>
    <div>
        <h1>404? that seems not good :(</h1>
        <?php if (isset($_GET['reason'])) {
            echo "<span>" . $_GET['reason'] . " is not found</span><br>";
        } ?>
        <span>just calm down and try to check the link you entered below</span>
        <br>
        <a href="index.php">Go home</a>
    </div>
</section>

<style>
    section, body, html {
        margin: 0;
        height: 100%;
        width: 100%;
    }

    div {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>

</body>
</html>
