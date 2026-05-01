<!DOCTYPE html>

<?php
    include(__DIR__ . '/../config/connectionData.php');
    $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');
?>

<html>

<head>
    <title>Pokemon Emerald Kaizo - Database TEMPLATE!</title>

    <link rel="stylesheet" href="style.css">
</head>

<body text="white" bgcolor="black">

    <h1>===== EK Database TEMPLATE! =====</h1>

    <?php
        include('header.php');
    ?>

    <body text="white" bgcolor="black">
        <script></script>
    </body>

    <?php
        include('footer.php');
    ?>

</html>